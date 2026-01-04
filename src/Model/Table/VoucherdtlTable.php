<?php
namespace App\Model\Table;

use Cake\ORM\Table;

class VoucherdtlTable extends Table
{
	var $useTable="voucher_dtls";
	var $name="voucher_dtls";
    public function initialize(array $config)
    {
		$this->Table('voucher_dtls');
	
		$this->primaryKey('VDT_ID');
        $this->addBehavior('Timestamp');
		$this->belongsTo('Purchase',[
            'foreignKey' => 'VCH_ID',
        ]);
		$this->belongsTo('Sales',[
            'foreignKey' => 'VCH_ID',
        ]);
		
    }
	

	
	
}
?>