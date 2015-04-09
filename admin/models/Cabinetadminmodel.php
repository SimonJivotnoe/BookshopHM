<?php


class Cabinetadminmodel {
    private $repArr = array('###ACTION###' => '');
    public function __construct() {

    }

    public function getHead(){
        $pdo = Pdoadmin::connect();
        $res = $pdo->select("date_time, price, order_status, order_id, user_id ")
            ->from("orders ORDER BY date_time DESC")
            ->exec();
        return $res;
    }

    public function changeOrderStatus($order_id, $status){
        $pdo = Pdoadmin::connect();
        $pdo->update("orders")
            ->set("order_status='$status'")
            ->where("order_id ='$order_id'")
            ->execInsert();
    }
    public function getArr($res)
    {
        $pdo = Pdoadmin::connect();
        $output = '<div class="col-md-11"><table class="table">
        <tbody>
        <tr>
            <th>Date</th>
            <th>Total Price $</th>
            <th>User ID</th>
            <th>Order ID</th>
            <th>Order_status</th>
        </tr>
        </tbody>
    </table></div>';
        $output .= '<div class="row col-md-12">
        <div class="panel-group" id="accordion">';
        $i = 1;
        foreach ($res as $key => $val){

            $order_id = (int)$val['order_id'];
            $output .= '<div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse'.$i.'">
                        <span class="col-md-2 accTitle">'.$val['date_time'].'</span>
                        <span class="col-md-2 accTitle">'.$val['price'].'</span>
                        <span class="col-md-2 accTitle">'.$val['user_id'].'</span>
                        <span class="col-md-2 accTitle">'.$val['order_id'].'</span>
                        <span class="col-md-2 accTitle">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp'.$val['order_status'].'</span>
                    </a>
                </h4>
            </div>
            <div id="collapse'.$i.'" class="panel-collapse collapse">
                <div class="panel-body">';
            $quantity = $pdo->select('book_id, quantity')
                ->from('book_to_order')
                ->where("order_id = '$order_id'")
                ->exec();
            $output .= '<div class="col-md-9">
                        <table class="table table-striped">
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
                $orderStatusList = $pdo->select('order_name')
                    ->from('order_status')
                    ->exec();               
                $orderStatusInTD = '<form method="POST" action="index.php?page=cabinetpaletteadminctrl&order_id='.$order_id.'">';
                $orderStatusInTD .= '<table>
                                    <tbody>
                                        <tr><th>Status Name</th></tr>';
                foreach ($orderStatusList as $key => $val) {
                    $orderStatusInTD .= '<tr>
                                            <td>
                                                <input type="radio" name="status" value="'.$val['order_name'].'"/>'.$val['order_name'].
                                            '</td>
                                            </tr>';
                }
                $orderStatusInTD .= '<tr><td><input type="submit" class="btn btn-primary" name="changeStatus" value="Change"/></td></tr></tbody></table></form>';
                $output .= '<tr><td>'.$bookNameAndPrice[0]['name'].'</td>
                    <td>'.$bookNameAndPrice[0]['price'].' $</td>
                    <td>'.$quan.'</td></tr>';
            }
            $output .= '</tbody>
                                </table></div><div class="col-md-3">'.$orderStatusInTD.'</div></div>
            </div>
        </div>';
            $i++;
        }
        $output .= '</div>
    </div>
</div>';
        $this->repArr['###ACTION###'] = $output;
        return $this->repArr;
    }
} 
