<?php
require_once "koneksi.php";
class car
{
    public function get_cars()
    {
        global $koneksi;
        $query = "SELECT * FROM cars";
        $data = array();
        $result = $koneksi->query($query);
        while ($row = mysqli_fetch_object($result)) {
            $data[] = $row;
        }
        $response = array(
            'status' => 1,
            'message' => 'list mobil berhasil',
            'data' => $data
        );
        header('Content-Type: application/json');
        echo json_encode($response);
    }
    public function get_car($id = 0)
    {
        global $koneksi;
        $query = "SELECT * FROM cars";
        if ($id != 0) {
            $query .= " WHERE id=" . $id . " LIMIT 1";
        }
        $data = array();
        $result = $koneksi->query($query);
        while ($row = mysqli_fetch_object($result)) {
            $data[] = $row;
        }
        $response = array(
            'status' => 1,
            'message' => 'Get Mobil berhasil',
            'data' => $data
        );
        header('Content-Type: application/json');
        echo json_encode($response);
    }
    public function insert_car()
    {
        global $koneksi;
        $arrcheckpost = array(
            'name' => '',
            'price' => '',
            'qty' => '',
            'color' => '',
            'brand' => ''
        );
        $hitung = count(array_intersect_key($_POST, $arrcheckpost));
        if ($hitung == count($arrcheckpost)) {
            $result = mysqli_query($koneksi, "INSERT INTO cars SET
name = '$_POST[name]',
price = '$_POST[price]',
qty = '$_POST[qty]',
color = '$_POST[color]',
brand = '$_POST[brand]'");
            if ($result) {
                $response = array(
                    'status' => 1,
                    'message' => 'mobil berhasil ditambahkan'
                );
            } else {
                $response = array(
                    'status' => 0,
                    'message' => 'mobil tidak berhasil ditambahkan'
                );
            }
        } else {
            $response = array(
                'status' => 0,
                'message' => 'Parameter Do Not Match'
            );
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    }
    function update_car($id)
    {
        global $koneksi;
        $arrcheckpost = array(
            'name' => '',
            'price' => '',
            'qty' => '',
            'color' => '',
            'brand' => ''
        );
        $hitung = count(array_intersect_key($_POST, $arrcheckpost));
        if ($hitung == count($arrcheckpost)) {
            $result = mysqli_query($koneksi, "UPDATE cars SET
name = '$_POST[name]',
price = '$_POST[price]',
qty = '$_POST[qty]',
color = '$_POST[color]',
brand = '$_POST[brand]'
WHERE id='$id'");
            if ($result) {
                $response = array(
                    'status' => 1,
                    'message' => 'Update mobil berhasil'
                );
            } else {
                $response = array(
                    'status' => 0,
                    'message' => 'Update mobil gagal'
                );
            }
        } else {
            $response = array(
                'status' => 0,
                'message' => 'Parameter Do Not Match'
            );
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    }
    function delete_car($id)
    {
        global $koneksi;
        $query = "DELETE FROM cars WHERE id=" . $id;
        if (mysqli_query($koneksi, $query)) {
            $response = array(
                'status' => 1,
                'message' => 'Hapus mobil berhasil'
            );
        } else {
            $response = array(
                'status' => 0,
                'message' => 'Hapus mobil gagal'
            );
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    }
}