<?php



    if (!isset($search_placeholder)) {
        $search_placeholder = 'Search for '.$search_options['name'].'...';
    }

    echo '<form action="" method="post" class="form-horizontal" role="form">';
      echo '<div class="input-group" id="adv-search">';
        echo '<input type="text" class="form-control input-sm" id="search-box" name="search-box" placeholder="'.$search_placeholder.'" />';
        echo '<div class="input-group-btn">';
          echo '<div class="btn-group">';
            echo '<div class="dropdown dropdown-lg">';
              echo '<button type="button" id="dropdown-btn" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Filters <span class="caret"></span></button>';
              echo '<!-- Dropdow menu start -->';
              echo '<div class="dropdown-menu dropdown-menu-right" role="menu">';
                  echo '<div class="form-group">';
                    echo '<label for="filter">Filter by</label>';
                    echo '<div class="form-inline">';

                    if(!empty($filter_options[$supplier])) {
                        
                        foreach ($filter_options[$supplier] as $filter_option) {

                                echo '<div class="checkbox">';
                                    echo '<label for="'.$filter_option['id'].'">';
                                    echo '<input type="checkbox" id="'.$filter_option['id'].'" name="'.$filter_option['id'].'" value="'.$filter_option['value'].'">'.$filter_option['text'];
                                    echo '</label>';
                                echo '</div> <!-- .checkbox -->';                                

                        }
                        

                    }

                    echo '</div> <!-- .form-inline -->';

                  echo '</div> <!-- .form-group -->';
                  echo '<button type="submit" class="btn btn-primary btn-block"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>';
              echo '</div> <!-- .dropdown-menu .dropdown-menu-right -->';
              echo '<!-- Dropdow menu end -->';
            echo '</div> <!-- dropdown dropdown-lg -->';
            echo '<button type="submit" class="btn btn-primary btn-sm" name="search"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>';
            
          echo '</div> <!-- .btn-group -->';
        echo '</div> <!-- .input-group-btn -->';
      echo '</div> <!-- .input-group -->';
      
      echo '</form>';

?>