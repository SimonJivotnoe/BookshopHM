<?php
/*

class CabinetPalette {
    private $repArr = array('%CABINET%' => '');
    public function __construct()
    {

    }

    public function getArr()
    {
        $pdo = DataBaseModel::connect();
        $res = DataContModel::getInstance()->getData();
        $output = '';
        $i = 1;
        foreach ($res as $key => $val){

            $order_id = (int)$val['order_id'];
             $output .= '<div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse'.$i.'">
                        <span class="col-md-4 accTitle">'.$val['date_time'].'</span>
                        <span class="col-md-4 accTitle">'.$val['price'].'</span>
                        <span class="col-md-4 accTitle">'.$val['order_status'].'</span>
                    </a>
                </h4>
            </div>
            <div id="collapse'.$i.'" class="panel-collapse collapse">
                <div class="panel-body">';
                $quantity = $pdo->select('book_id, quantity')
                            ->from('book_to_order')
                            ->where("order_id = '$order_id'")
                            ->exec();
                     $output .= '<table class="table col-md-8 table-striped">
                                    <tbody>
                                        <tr>
                                            <th>Book Name</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                        </tr>';

                foreach ($quantity as $keyQ => $value){
                    $book_id = $value['book_id'];
                    $quan = $value['quantity'];
                    $bookNameAndPrice = $pdo->select('name, price')
                        ->from('books')
                        ->where("id = '$book_id'")
                        ->exec();
                    $output .= '<tr><td>'.$bookNameAndPrice[0]['name'].'</td>
                    <td>'.$bookNameAndPrice[0]['price'].' $</td>
                    <td>'.$quan.'</td></tr>';

                }
            $output .= '</tbody>
                                </table></div>
            </div>
        </div>';
            $i++;
        }
        $this->repArr['%CABINET%'] = $output;
        return $this->repArr;
    }
} */

/**
 * Class CabinetPalette
 */
class CabinetPalette {
    private $repArr = array('%CABINET%' => '');

    /**
     *
     */
    public function __construct()
    {

    }

    /**
     * @return array
     */
    public function getArr()
    {
        $pdo = DataBaseModel::connect();
        $res = DataContModel::getInstance()->getData();
        $sub = new SubstitutionModel();
        $i = 1;
        $output = '';
        $tableRow = '';
        foreach ($res as $key => $val){
            $order_id = (int)$val['order_id'];
            $tableBody = array('%DATE_TIME%' => $val['date_time'],
                               '%PRICE_TOTAL%' => $val['price'],
                               '%ORDER_STATUS%' => $val['order_status'],
                               '%I%' => $i,);
            $quantity = $pdo->select('book_id, quantity')
                ->from('book_to_order')
                ->where("order_id = '$order_id'")
                ->exec();
            foreach ($quantity as $keyQ => $value){
                $book_id = $value['book_id'];
                $quan = $value['quantity'];
                $bookNameAndPrice = $pdo->select('name, price')
                    ->from('books')
                    ->where("id = '$book_id'")
                    ->exec();
                $trArray = array('%BOOKNAME%' => $bookNameAndPrice[0]['name'],
                                  '%BOOKPRICE%' => $bookNameAndPrice[0]['price'],
                                  '%QUANTITY%' => $quan,);
                $tableRow .= $sub->subHTMLReplace('subCabinetTR.html', $trArray);
            }
            $i++;
            $tableBody['%TABLEROW%'] = $tableRow;
            $output .= $sub->subHTMLReplace('subCabinet.html', $tableBody);
        }
        $this->repArr['%CABINET%'] = $output;
        return $this->repArr;
    }
} 
