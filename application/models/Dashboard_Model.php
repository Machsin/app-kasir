<?php
class Dashboard_model extends CI_Model
{

    public function tampilsale($bln = null)
    {
        $thn = date('Y');
        $awal = $thn . '-' . $bln . '-01';
        $akhir = $thn . '-' . $bln . '-31';
        $where = ['date >=' => $awal, 'date <=' => $akhir];
        $query = $this->db->select('SUM(final_price) as total')
            ->from('tb_sale');
        if ($where != null) {
            $query->where($where);
        }
        return $query->get()->row()->total;
    }
    public function tampilsalehari($hri)
    {
        $thn = date('Y');
        $bln = date('m');
        $query = $this->db->select('SUM(final_price) as total')
            ->from('tb_sale')
            ->where('date',$thn.'-'.$bln.'-'.$hri);
        return $query->get()->row()->total;
    }
}
