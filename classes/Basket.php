<?php

    /**
     * Basket's data
     */
    class Basket {


       
        /**
         * add book id to array (in $_COOKIE)
         * @param integer $bookId id of the book to be added
         * 
         * @return 
         */

         public static function addToBasket(int $bookId) {
             
           if (isset($_COOKIE['basket'])) {
            $basket = json_decode($_COOKIE['basket']);
                if (! in_array($bookId, $basket )) {
                  $basket[] = $bookId;
                  setcookie('basket', json_encode($basket));
                  return true;
                } else {
                    return false;
                }
           } else {
            $basket[] = $bookId;
            setcookie('basket', json_encode($basket));
            return true;
           }
         }
         /**
          * Returns all books ids in the basket
          * @return array of ids
          */
           public static function getBasket()
            {
                return json_decode($_COOKIE['basket']);
           }

           /** 
            * Checks if the item is in the basket
            * @return bool true if it's in the basket already
            */
           public static function isInTheBasket($bookId) 
           {
                if (isset($_COOKIE['basket'])) {
                    $basket = json_decode($_COOKIE['basket']);
                    return in_array($bookId, $basket);
                }
           }
        
    
}