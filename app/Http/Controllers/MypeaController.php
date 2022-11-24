<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Exception;

class MypeaController extends Controller {

    public $results;
    public $table;
    public $request;

    public function __construct(Request $request) {
        $this->request = $request;
    }

    public function index($table = '') {
        $this->table = $table;
        if ($this->table == '') {
            $this->results = DB::select("SHOW TABLES");
        } else {
            $this->results = DB::select("SELECT * FROM " . $this->table);
        }
        return $this->show_rows();
    }

    public function show_rows() {

        $ctr = ($this->table == '' ? true : false);
        $url = $this->request->url();
        $url_base = substr($url,0,strrpos($url,"/"));
        $columns = array();
        $rows = array();
        $head = '';
        $footer = '';

        if (!$ctr) {
            $head = "
            <style>
                td:nth-child(1), td:nth-child(2), td:nth-child(3) {
                    width: 60px;
                }
            </style>            
            ";
        }

        foreach ($this->results as $row) {
            $record = (array)$row;
            foreach ($record as $field => $value) {
                $columns[] = $field;
            }
            if ($ctr) {
                $columns[] = "Rows";
            }
            break;
        }

        $i = 0;
        $key = 0;
        foreach ($this->results as $row) {
            $record = (array)$row;
            if (!$ctr) {
                $rows[$i][0] = "";
                $rows[$i][1] = "";
            }
            $key_ctr = 0;
            foreach ($record as $field => $value) {
                if ($ctr) {
                    $rows[$i][] = "<a href='$url/$value'>$value</a>";
                    $numrows = DB::select("SELECT COUNT(*) AS numrows FROM $value");
                    $rows[$i][] = $numrows[0]->numrows;
                } else {
                    $rows[$i][] = $value;
                    if ($key_ctr == 0) $key = $value;
                }
                $key_ctr++;
            }
            if (!$ctr) {
                $rows[$i][0] = "<a href='$url_base/".$this->table."/$key/edit' class='btn btn-outline-info btn-sm'>Edit</a>";
                $rows[$i][1] = "<button type='button' onClick='fnDelete(\"".$this->table."\",$key);' class='btn btn-outline-danger btn-sm'>Delete</button>";
            }
            $i++;
        }

        $data = array(
            'url_base' => $url_base,
            'columns' => $columns,
            'rows' => $rows,
            'head' => $head,
            'footer' => $footer,
            'table' => $this->table,
            'request' => $this->request,
        );

        if ($ctr) 
            return view('mypea.tables', $data);
        else
            return view('mypea.tablelist', $data);

    }

    public function new($table) {
        $this->table = $table;
        $url = $this->request->url();
        $url_base = substr($url,0,strrpos($url,"/"));
        $url_base = substr($url_base,0,strrpos($url_base,"/"));
        $head = '';
        $footer = '';
        $fields = array();

        $this->results = DB::select("SHOW COLUMNS FROM " . $this->table);

        foreach ($this->results as $row) {
            if (trim($row->Extra) == '') {
                $fields[] = $row->Field;
            }
        }

        $data = array(
            'url_base' => $url_base,
            'head' => $head,
            'footer' => $footer,
            'table' => $this->table,
            'fields' => $fields, 
        );

        return view('mypea.new', $data);
    }

    public function insert() {
        $table = $this->request->input('table_name');
        $this->results = DB::select("SHOW COLUMNS FROM " . $table);
        $fields = array();
        foreach ($this->results as $row) {
            if (trim($row->Extra) == '') {
                if ($this->request->input($row->Field) != null) {
                    $fields[$row->Field] = $this->request->input($row->Field);
                } else {
                    if ($row->Null == 'NO') {
                        $fields[$row->Field] = "";
                    }
                }
            }
        }

        try {
            DB::table($table)
                ->insert($fields);
        } catch (Exception $e) {
            $this->request->session()->flash('mypea_msg_text','<strong>Error</strong> ' . $e->getMessage());
            $this->request->session()->flash('mypea_msg_color','danger');
            return redirect('mypea/' . $table);
        }

        $this->request->session()->flash('mypea_msg_text','<strong>Success!</strong> Record inserted!');
        $this->request->session()->flash('mypea_msg_color','success');
        return redirect('mypea/' . $table);
    }

    public function edit($table, $id) {
        $this->table = $table;
        $url = $this->request->url();
        $url_base = substr($url,0,strrpos($url,"/"));
        $url_base = substr($url_base,0,strrpos($url_base,"/"));
        $url_base = substr($url_base,0,strrpos($url_base,"/"));
        $head = '';
        $footer = '';
        $fields = array();

        $this->results = DB::select("SHOW COLUMNS FROM " . $this->table);

        foreach ($this->results as $row) {
            if (trim($row->Extra) == '') {
                $fields[] = $row->Field;
            }
        }

        $this->results = DB::select("SELECT * FROM " . $this->table . " WHERE id = " . $id);
        foreach ($this->results as $row) {
            $values = (array)$row;
        }

        $data = array(
            'url_base' => $url_base,
            'head' => $head,
            'footer' => $footer,
            'table' => $this->table,
            'id' => $id,
            'fields' => $fields, 
            'values' => $values,
        );

        return view('mypea.edit', $data);

    }

    public function update() {
        $table = $this->request->input('table_name');
        $id = $this->request->input('id');
        $this->results = DB::select("SHOW COLUMNS FROM " . $table);
        $fields = array();
        foreach ($this->results as $row) {
            if (trim($row->Extra) == '') {
                if ($this->request->input($row->Field) != null) {
                    $fields[$row->Field] = $this->request->input($row->Field);
                } else {
                    if ($row->Null == 'NO') {
                        $fields[$row->Field] = "";
                    }
                }
            }
        }

        try {
            DB::table($table)
                ->where('id', $id)
                ->update($fields);
        } catch (Exception $e) {
            $this->request->session()->flash('mypea_msg_text','<strong>Error</strong> ' . $e->getMessage());
            $this->request->session()->flash('mypea_msg_color','danger');
            return redirect('mypea/' . $table);
        }

        $this->request->session()->flash('mypea_msg_text','<strong>Success!</strong> Record updated!');
        $this->request->session()->flash('mypea_msg_color','success');
        return redirect('mypea/' . $table);
    }

    public function delete($table, $id) {
        try {
            DB::delete("DELETE FROM $table WHERE id = ?",[$id]);
        } catch (Exception $e) {
            $this->request->session()->flash('mypea_msg_text','<strong>Error</strong> ' . $e->getMessage());
            $this->request->session()->flash('mypea_msg_color','danger');
            return redirect('mypea/' . $table);
        }
        $this->request->session()->flash('mypea_msg_text','<strong>Success!</strong> Record deleted!');
        $this->request->session()->flash('mypea_msg_color','success');
        return redirect('mypea/' . $table);
    }


}