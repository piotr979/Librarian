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

           /**
            * Check if is x (4 by default) in the basket
            * @return boolean true if limited is reached, false otherwise
            */
        
            public static function isLimitReached()
             {
                if (isset($_COOKIE['basket'])) {
                return (count(json_decode($_COOKIE['basket'])) == 4 ? true : false);
                } else {
                    return false;
                }
            }

            /**
             * remove a book from basket
             * @param integer Id item to be removed
             * @return boolean true if success
             */

             public static function removeBook(int $id) 
             {
                if (isset($_COOKIE['basket'])) {
                    $basket = json_decode($_COOKIE['basket']);

                    $index = array_search($id, $basket);
        
                  setcookie('index', $index);
                   unset($basket[$index]);
                   setcookie('basket', json_encode($basket));
                }
             }

    
}