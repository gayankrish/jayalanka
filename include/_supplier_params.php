<?php

$arr_classes = array('hotel'=>'Hotel', 'guide'=>'Guide', 
                     'vehicle'=>'Vehicle', 'restaurant'=>'Restaurant',
                     'shop'=>'Shop', 'activity_providers' => 'ActivityProvider');

$arr_page_titles = array('hotel'=>'Hotels', 'guide'=>'Guides', 
                         'vehicle'=>'Vehicles', 'restaurant'=>'Restaurants',
                         'shop'=>'Shops', 'activity_providers' => 'Activity Providers');

$arr_table_headings = array('hotel'=>array('display_name'=>'Hotel Name', 'location'=>'Location', 'contact_nos'=>'Contact Nos', 'rank'=>'Rating', 'actions'=>'Actions'),
                            'vehicle'=>array('model'=>'Model', 'type'=>'Type', 'seating_capacity'=>'Seating Capacity', 'owner_name'=>'Owner', 'owner_contact_nos'=>'Contact Nos', 'actions'=>'Actions'),
                            'guide'=>array('title'=>'Title', 'name'=>'Name', 'type'=>'Type', 'languages'=>'Languages', 'contact_nos'=>'Contact Nos', 'actions'=>'Actions'),
                            'restaurant'=>array('name'=>'Name', 'type'=>'Type', 'location'=>'Location', 'contact_nos'=>'Contact Nos', 'actions'=>'Actions'),
                            'shop'=>array('name'=>'Name', 'chain'=>'Chain', 'type'=>'Type', 'location'=>'Location', 'contact_nos', 'actions'=>'Actions'),
                            'activity_providers'=>array('name'=>'Name', 'activity_types'=>'Activity Types', 'location'=>'Location', 'contact_person'=>'Contact Person', 'contact_nos'=>'Contact Nos', 'actions'=>'Actions'));

$actions = '<td class="text-center">                        
            <a href="'.SITE_URL.'/?page=view_supplier&supplier=%supplier_type%&name=%supplier_name%&id=%record_id%" class="btn btn-xs btn-default" id="show-hotel-details" title="Show Details" name="%record_id%"><i class="glyphicon glyphicon-list-alt"></i></a>
            <a href="'.SITE_URL.'/?page=edit_supplier&supplier=%supplier_type%&name=%supplier_name%&id=%record_id%" class="btn btn-xs btn-default" id="edit-hotel-details" title="Edit" name="%record_id%"><i class="glyphicon glyphicon-edit"></i></a>
            <button class="btn btn-xs btn-danger delete-supplier" id="delete-supplier" data-supplier="%supplier%" data-supplier-name="%supplier_name%" title="Delete" name="%record_id%" data-toggle="modal" data-target="#delete-supplier-modal" data-backdrop="static" data-keyboard="false"><i class="glyphicon glyphicon-trash"></i></button>
            </td>';
            
$arr_ref_data = array('hotel'=> array('country' => array('class'=>'Country', 'method'=>'getCountries'),
                                      'hotel_type' => array('class'=>'Hotel', 'method'=>'getHotelTypes'),
                                      'chain_type' => array('class'=>'Hotel', 'method'=>'getHotelChains')));

?>