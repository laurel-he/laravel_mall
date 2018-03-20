<?php
/**
* 生成商品编号 （goods_sn、sku_sn）
* 订单号
*/
namespace App\Alg;

class Sn 
{	
    
    const ORDER = 'OR';
    const ASSIGN = 'AS';
    const IN_ENTREPOT= 'IN';
    const OUT_ENTREPOT = 'OU';
    const ORDER_RETURN = 'RE';
    const ORDER_EXCHANGE = 'EX';
    
	/**
	 * 生成商品编号
	 * @param int $c
	 * 
	 * @return string G000A
	 */
	public static function getGoodsSn($c, $len = 4)
	{
		return 'G'. self::getSn($c, $len);
	}
	
	/**
	 * 生成sku_sn
	 * @param int $c
	 * @param number $len
	 */
	public static function getSkuSn($c, $len = 4)
	{
		return 'K'.self::getSn($c, $len);
	}
	
	
	
	/**
	 * 生成 sn
	 * @param unknown $c 当前总数
	 * @param number $len
	 * @return string
	 */
	public static function getSn($c, $len = 4)
	{
		return sprintf("%04X", ++$c);
	}
	
	/**
	 * 生成单号
	 * @param string $pre  上面的常量
	 * @param string $base 仓库的简写
	 * @param number $c 总数
	 * 
	 * @return string
	 */
	public static function getDanSn($pre, $base, $c)
	{
	    return $pre.Date('Ymd').$base. self::getSn($c, DAN_NUM_LENGTH);
	}
	
	/**
	 * 生成订单号
	 * 
	 * @param string $base
	 * @param number $c
	 * 
	 * @return sring
	 */
	public static function getOrderSn($base, $c)
	{
	    return self::getDanSn(self::ORDER, $base, $c);
	}
	
	/**
	 * 生成 配货单（发货单） 号
	 * 
	 * @param string $base
	 * @param number $c
	 * 
	 * @return string 
	 */
	public static function getAssignSn($base, $c)
	{
	    return self::getDanSn(self::ASSIGN, $base, $c);
	}
	
	/**
	 * 生成入库单号
	 * 
	 * @param string $base
	 * @param number $c
	 * 
	 * @return string
	 */
	public static function getInSn($base, $c)
	{
	    return self::getDanSn(self::IN_ENTREPOT, $base, $c);
	}
	
	/**
	 * 生成出库单号
	 *
	 * @param string $base
	 * @param number $c
	 *
	 * @return string
	 */
	public static function getOuSn($base, $c)
	{
	    return self::getDanSn(self::OUT_ENTREPOT, $base, $c);
	}
	
	/**
	 * 生成退货单号
	 *
	 * @param string $base
	 * @param number $c
	 *
	 * @return string
	 */
	public static function getReSn($base, $c)
	{
	    return self::getDanSn(self::ORDER_RETURN, $base, $c);
	}
	
	/**
	 * 生成换货单号
	 *
	 * @param string $base
	 * @param number $c
	 *
	 * @return string
	 */
	public static function getExSn($base, $c)
	{
	    return self::getDanSn(self::ORDER_EXCHANGE, $base, $c);
	}
}