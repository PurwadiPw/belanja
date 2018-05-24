<?php
//sebelum query, load dulu library database-nya
include_once "libraries/Database.php";

class Model
{
    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    public function noPenjualan($session_id = null)
    {
        $sql = "SELECT no_penjualan, temp_session FROM jual";

        if ($session_id == null) {
            $sql .= " ORDER BY no_penjualan DESC LIMIT 0,1";
        } else {
            $sql .= " WHERE temp_session='".$session_id."' GROUP BY temp_session";
        }

        $data = $this->db->get_one($sql);
        if ($data == null) {
            $urut = 1;
        } else {
            $no_penjualan = intval(substr($data->no_penjualan, -5));
            if ($session_id == null && ($data->temp_session != session_id())) {
                $urut = $no_penjualan+1;
            } elseif ($data->temp_session == session_id()) {
                $urut = $no_penjualan;
            } else {
                $urut = $no_penjualan;
            }
        }

        $no_pjl = 'PJL'.sprintf('%05d', $urut);
        return $no_pjl;
    }

    public function cartList($where)
    {
        $kondisi = [];
        foreach ($where as $kolom => $value) {
            if (strpos($value, '.')) {
                $kondisi[] = $kolom . "=" . $value . "";
            } else {
                $kondisi[] = $kolom . "='" . $value . "'";
            }
        }
        $sql = "SELECT jual.id AS jual_id, products.id AS produk_id, jual.*, products.* FROM jual,products WHERE ".implode(' AND ', $kondisi);
        $response = $this->db->get_all($sql);
        return $response;
    }

    public function select($tbl, $where = null, $field = "*")
    {
        $response = null;
        $sql      = "SELECT " . $field . " FROM " . $tbl . "";

        // banyak data
        $response = $this->db->get_all($sql);

        // jika satu data
        if ($where != null && is_array($where)) {
            $kondisi = [];
            foreach ($where as $kolom => $value) {
                $kondisi[] = $kolom . "='" . $value . "'";
            }
            $kondisi = implode(' AND ', $kondisi);
            $sql .= " WHERE " . $kondisi . "";
            $response = $this->db->get_one($sql);
        } elseif ($where != null && !is_array($where)) {
            $sql .= " WHERE ".$where;
            $response = $this->db->get_all($sql);
        }

        return $response;
    }

    public function insert($table, $data) //fungsi insert

    {
        $field = array();
        $nilai = array();
        foreach ($data as $kolom => $value) {
            $field[] = $kolom;
            $nilai[] = "'" . $value . "'";
        }

        $response = $this->db->query("INSERT INTO " . $table . "(" . implode(',', $field) . ") VALUES (" . implode(',', $nilai) . ")");
        return $response;
    }

    public function update($table, $data, $where) //fungsi update
    {
        $set = [];
        foreach ($data as $kolom => $value) {
            $set[] = $kolom . "='" . $value . "'";
        }
        $set      = implode(',', $set);
        $query    = "UPDATE " . $table . " SET " . $set . " WHERE " . $where;
        $response = $this->db->query($query);
        return $response;
    }

    public function delete($table, $where) //fungsi delete

    {
        $this->db->query("DELETE FROM " . $table . " WHERE " . $where);
    }

}
