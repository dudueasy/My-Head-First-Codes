<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Risky Jobs - Search</title>
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>

<body>
  <img src="riskyjobs_title.gif" alt="Risky Jobs" />
  <img src="riskyjobs_fireman.jpg" alt="Risky Jobs" style="float:right" />
  <h3>Risky Jobs - Search Results</h3>


  <?php

function build_query($user_search, $sort){
    $search_query = "SELECT * FROM riskyjobs where ";
    //extract the search keywords into an array
    $search_word = explode(' ',str_replace(',',' ',$user_search));
    $final_search_words = array();
    if(count($search_word) > 0){
        foreach($search_word as $word){
            if(!empty($word)){
                $final_search_words[] = $word;
            }
        }
    }
    $where_list = array();
    foreach($final_search_words as $word){
        $where_list[] = " description Like '%$word%'";
    }
    $where_clause = implode(' or ',$where_list);
    if(!empty($where_clause)){
        $search_query .= "$where_clause";
    }
    switch($sort){
        case 1:
            $search_query .= " ORDER BY title";
            break;
        case 2:
            $search_query .= " ORDER BY title DESC";
            break;
        case 3:
            $search_query .= " ORDER BY state";
            break;
        case 4:
            $search_query .=" ORDER BY state DESC";
            break;
        case 5:
            $search_query .= " ORDER BY date_posted";
            break;
        case 6:
            $search_query .= " ORDER BY date_posted DESC";
            break;
        default:
    }
    
    return $search_query;
}

function generate_sort_links($user_search, $sort){
    $sort_links = "";


 
switch($sort){
        case 1:
            $sort_links .= '<td><a href="'. $_SERVER['PHP_SELF'].'?usersearch='.$user_search.
            '&sort=2">Job Title</a></td><td>Description</td>';
            $sort_links .= '<td><a href="'.$_SERVER['PHP_SELF'].'?usersearch='.$user_search.
            '&sort=3">state</a></td>';
            $sort_links .= '<td><a href="'.$_SERVER['PHP_SELF'].'?usersearch='.$user_search.
            '&sort=5">Date Posted</a></td>';
            break;
        case 2:
            $sort_links .= '<td><a href="'. $_SERVER['PHP_SELF'].'?usersearch='.$user_search.
            '&sort=1">Job Title</a></td><td>Description</td>';
            $sort_links .= '<td><a href="'.$_SERVER['PHP_SELF'].'?usersearch='.$user_search.
            '&sort=3">state</a></td>';
            $sort_links .= '<td><a href="'.$_SERVER['PHP_SELF'].'?usersearch='.$user_search.
            '&sort=5">Date Posted</a></td>';
            break;
        case 3:
            $sort_links .= '<td><a href="'. $_SERVER['PHP_SELF'].'?usersearch='.$user_search.
            '&sort=1">Job Title</a></td><td>Description</td>';
            $sort_links .= '<td><a href="'.$_SERVER['PHP_SELF'].'?usersearch='.$user_search.
            '&sort=4">state</a></td>';
            $sort_links .= '<td><a href="'.$_SERVER['PHP_SELF'].'?usersearch='.$user_search.
            '&sort=5">Date Posted</a></td>';
            break;
        case 4:
            $sort_links .= '<td><a href="'. $_SERVER['PHP_SELF'].'?usersearch='.$user_search.
            '&sort=1">Job Title</a></td><td>Description</td>';
            $sort_links .= '<td><a href="'.$_SERVER['PHP_SELF'].'?usersearch='.$user_search.
            '&sort=3">state</a></td>';
            $sort_links .= '<td><a href="'.$_SERVER['PHP_SELF'].'?usersearch='.$user_search.
            '&sort=5>"Date Posted</a></td>';
            break;
        case 5:
            $sort_links .= '<td><a href="'. $_SERVER['PHP_SELF'].'?usersearch='.$user_search.
            '&sort=1">Job Title</a></td><td>Description</td>';
            $sort_links .= '<td><a href="'.$_SERVER['PHP_SELF'].'?usersearch='.$user_search.
            '&sort=3">state</a></td>';
            $sort_links .= '<td><a href="'.$_SERVER['PHP_SELF'].'?usersearch='.$user_search.
            '&sort=6">Date Posted</a></td>';
            break;
        case 6:
            $sort_links .= '<td><a href="'. $_SERVER['PHP_SELF'].'?usersearch='.$user_search.
            '&sort=1">Job Title</a></td><td>Description</td>';
            $sort_links .= '<td><a href="'.$_SERVER['PHP_SELF'].'?usersearch='.$user_search.
            '&sort=3">state</a></td>';
            $sort_links .= '<td><a href="'.$_SERVER['PHP_SELF'].'?usersearch='.$user_search.
            '&sort=5">Date Posted</a></td>';
            break;
        default:
                $sort_links .= '<td><a href="'. $_SERVER['PHP_SELF'].'?usersearch='.$user_search.
                '&sort=1">Job Title</a></td><td>Description</td>';
                $sort_links .= '<td><a href="'.$_SERVER['PHP_SELF'].'?usersearch='.$user_search.
                '&sort=3">state</a></td>';
                $sort_links .= '<td></a href="'.$_SERVER['PHP_SELF'].'?usersearch='.$user_search.
                '&sort=5">Date Posted</a></td>';
                break;
    }
    return $sort_links;
}


function generate_page_links($user_search, $sort, $cur_page, $num_pages){
    $page_links= '';
    
    //previous page anchor "<-"
    if( $cur_page >1 ){
        //display a arrow  "<-" with link
        $page_links .= '<a href="'.$_SERVER['PHP_SELF'].'?usersearch=' .$user_search. 
        '&sort='.$sort.
        '&page='.($cur_page-1). '"><-</a> ';
    } 
    else{
        //display a arrow without link
        $page_links .='<- ';
        
    }
    //loop through the pages generating the page number links
    for( $i=1; $i<=$num_pages;$i++){
        if ($cur_page == $i){
            //for current page, only display a page number
            $page_links .= ' '.$i;
        }
        else{
            //display a link with page number.
            $page_links .= ' <a href="'.$_SERVER['PHP_SELF'].'?usersearch='.$user_search.
            '&sort='.$sort.
            '&page='.$i.'">'.$i .'</a>';
        }
    }
    
    //next page anchor "->";
    if($cur_page <$num_pages){
        $page_links .='<a href="'.$_SERVER['PHP_SELF'].
        '.?usersearch='.$user_search.'&sort='.$sort.'&page='.($cur_page + 1).'">-></a>';
    }
    else {
    $page_links .=' ->';
    }
    
    return $page_links;
}



// Grab the sort setting and search keywords from the URL using GET
if(isset($_GET['sort'])){
    $sort = $_GET['sort'];
}else{
    $sort = 1;
}
$user_search = $_GET['usersearch'];

$cur_page = isset($_GET['page'])?$_GET['page']:1;
$results_per_page = 5;
$skip = ($cur_page - 1) * $results_per_page;

// Start generating the table of results
echo '<table border="0" cellpadding="2">';

// Generate the search result headings
echo '<tr class="heading">';
echo generate_sort_links($user_search, $sort);
echo '</tr>';

// Connect to the database
require_once('connectvars.php');
$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

// Query to get the results
$query = build_query($user_search, $sort);
$result = mysqli_query($dbc, $query);
$total = mysqli_num_rows($result);
$num_pages = ceil($total/$results_per_page);

// Query to get subset of results
$query .= " LIMIT $skip, $results_per_page";
echo $query;
$result = mysqli_query($dbc, $query);

while ($row = mysqli_fetch_array($result))
{
    echo '<tr class="results">';
    echo '<td valign="top" width="20%">' . $row['title'] . '</td>';
    echo '<td valign="top" width="50%">' . substr($row['description'], 0, 100) . '</td>';
    echo '<td valign="top" width="10%">' . $row['state'] . '</td>';
    echo '<td valign="top" width="20%">' . substr($row['date_posted'], 0, 10) . '</td>';
    echo '</tr>';
}
echo '</table>';

//generate navigational page links if we have more than one page
if($num_pages > 1){
    echo generate_page_links($user_search, $sort, $cur_page, $num_pages);
}

mysqli_close($dbc);
?>

</body>

</html>