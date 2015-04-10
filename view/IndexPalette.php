<?php

/*
class IndexPalette
{
    private $repArr = array('%AUTHORIZATION%' => '<form method="POST" action="index.php?page=authorizationctrl" class="col-md-4 authorization">
        <div class="form-group col-md-5">
            <label for="exampleInputName2">Name</label>
            <input type="text" name="loginAUTH" class="form-control" id="exampleInputName2" placeholder="Jane Doe">
        </div>
        <div class="form-group col-md-5">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" name="passAUTH" class="form-control" id="exampleInputPassword1" placeholder="Password">
        </div>
        <input type="submit" name="authorization" value="Log In" class="btn btn-primary col-md-2 login" />
         <div class="col-md-8 wellcomeGuest">%WELLCOMEGUEST%</div>
        <div class="col-md-4 registration"><a href="index.php?page=registrationctrl">Registration</a></div>
    </form>', '%NEWCOMER%' => '',);

    public function __construct()
    {

    }

    public function getArr()
    {
        $obj = DataContModel::getInstance();
        $res = $obj->getInfoFlag();
        $objSess = new SessionModel();
        $sesCheck = $objSess->read('BookshopLogin');
        if ( ! $sesCheck) {
            return $this->repArr;
        } else {
            if ($res == 'newcomer') {
                $this->repArr[ '%NEWCOMER%' ] = 'Registration successful. Now Log in and buy books
                    <span class="glyphicon glyphicon-pushpin" aria-hidden="true"></span>';
                $obj->clearInfoFlag();

                return $this->repArr;

            } else {
                $this->repArr[ '%AUTHORIZATION%' ] = '<div class="col-md-2 wellcome">WELLCOME ' .
                    $_SESSION[ 'BookshopLogin' ] . '</div>
                    <div class="col-md-1 logOff">
                    <form method="POST" action="index.php?page=logoffctrl">
                    <input type="submit" value="Log Off" class="btn btn-danger" />
                    </form>
                    </div>
                        <div class="col-md-1 inCart">
        <div class="items"><span>0</span> items</div>
        <a href="index.php?page=cartctrl">
            <span class="glyphicon glyphicon-shopping-cart cart" aria-hidden="true"></span></a>
        <div class="price"><span>0</span> $</div>
    </div>
    <div class="col-md-1 inCart">
        <a href="index.php?page=cabinetctrl">
        <span class="glyphicon glyphicon-book cabinet pull-left" aria-hidden="true"></span></a>
    </div>';
                return $this->repArr;
            }

        }
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
        $this->repArr['%CABINET%'] = $output;
        foreach ($res as $key => $val){
            $trArray = array();
            $tableRow = '';
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
