<?php 

namespace CBS\Src;

class Admin{

    function __construct(){
        
        add_filter( 'manage_edit-product_columns', [$this, 'cbs_manage_columns'] );
        add_action( 'manage_product_posts_custom_column', [$this, 'cbs_display_product_hour'], 10, 2 );
    }

    /**
     * Managing Products Columns
    */
    function cbs_manage_columns( $columns ) {

        //Remove all extra column form product table
        unset( $columns['thumb'] );
        unset( $columns['sku'] );
        unset( $columns['is_in_stock'] );
        unset( $columns['product_cat'] );
        unset( $columns['product_tag'] );
        unset( $columns['price'] );
        unset( $columns['featured'] );
        unset( $columns['date'] );

        //Set Extra columns in product table
        $columns['slot_hour']   = 'Hour';
        $columns['slot']        = 'Slot';
        $columns['price']       = 'Price';
        $columns['date']        = 'Date';

        return $columns;
    }

    /**
     * Display Slot hour in product Column
     */
    function cbs_display_product_hour( $column, $post_id ) {

        //Slot column added into product table
        if( $column == 'slot' ){
            printf( " %1s ", get_field( 'slot_date', $post_id, true ) );
        }

        //Slot Hour column added into product table
        if( 'slot_hour' == $column ) {

            //get current product terms
            $terms = get_the_terms( $post_id, 'slot_hour' );

            if ( $terms && ! is_wp_error( $terms ) ) {

                $term_names = array();
                foreach ( $terms as $term ) {
                    $term_names[] = $term->name;
                }
                printf( " %1s ", implode( ', ', $term_names ) );
            } else {
                printf( "%1s", __( 'No slot hours' ) );
            }
        }
    }
}