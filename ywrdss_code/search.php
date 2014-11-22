<?php
//ini_set('display_errors',1);
//error_reporting(E_ALL);
$conn_string = "host=localhost port=5432 dbname=water_rights user=****** password=******";
$dbconn = pg_connect($conn_string);
if (!$dbconn)
  {
  echo 'Connection attempt failed.';
  }
$term = $_POST['search_term'];
$type = $_POST['type_term'];
$term = sanitize($term);
$type= sanitize($type);
$term = strtolower($term);

 if ($term == "") 
 { 
 echo "<p>Please enter a search term."; 
 exit; 
 }  

echo '<h2 style="margin-bottom: 5px; text-decoration: underline;">Results</h2>';
$n = 0;

$rowsperpage = 30;

switch ($type)
{

case 'basin':

$query = "SELECT ST_XMax(the_geom),ST_XMin(the_geom),ST_YMax(the_geom),ST_YMin(the_geom), basin FROM gwis_new2 WHERE lower(basin) LIKE '%$term%' ORDER BY basin";
$result = pg_exec($query);
$rows = pg_num_rows($result);
$numrows = $rows; 

// number of rows to show per page
//$rowsperpage = 32;
// find out total pages
$totalpages = ceil($numrows / $rowsperpage);

// get the current page or set a default


if (isset($_POST['current']) && is_numeric($_POST['current'])) {
//    cast var as int
   $currentpage = (int) $_POST['current'];
} else {
//    default page num
   $currentpage = 1;
} // end if

// if current page is greater than total pages...
if ($currentpage > $totalpages) {
//    set current page to last page
   $currentpage = $totalpages;
} // end if
// if current page is less than first page...
if ($currentpage < 1) {
//    set current page to first page
   $currentpage = 1;
} // end if

// the offset of the list, based on current page 
$offset = ($currentpage - 1) * $rowsperpage;
// get the info from the db   

$query = "SELECT ST_XMax(the_geom),ST_XMin(the_geom),ST_YMax(the_geom),ST_YMin(the_geom), basin FROM gwis_new2 WHERE lower(basin) LIKE '%$term%' ORDER BY basin LIMIT $rowsperpage OFFSET $offset";
$result = pg_exec($query);

while ($row = pg_fetch_row($result)) {
  $xmax = $row[0];
  $xmin = $row[1];
  $ymax = $row[2];
  $ymin = $row[3];
  $name = $row[4];
echo "<a href=\"javascript:centersearchfeature('".$xmax."','".$xmin."','".$ymax."','".$ymin."');\">".$name."</a><br>";
++$n;
}
paging_links($currentpage,$totalpages, $n);
break;

case 'reser':

$query = "SELECT ST_XMax(the_geom),ST_XMin(the_geom),ST_YMax(the_geom),ST_YMin(the_geom), gnisname FROM storageres WHERE lower(gnisname) LIKE '%$term%' ORDER BY gnisname";
$result = pg_exec($query);
$rows = pg_num_rows($result);
$numrows = $rows; 

// number of rows to show per page
//$rowsperpage = 32;
// find out total pages
$totalpages = ceil($numrows / $rowsperpage);

// get the current page or set a default


if (isset($_POST['current']) && is_numeric($_POST['current'])) {
//    cast var as int
   $currentpage = (int) $_POST['current'];
} else {
//    default page num
   $currentpage = 1;
} // end if

// if current page is greater than total pages...
if ($currentpage > $totalpages) {
//    set current page to last page
   $currentpage = $totalpages;
} // end if
// if current page is less than first page...
if ($currentpage < 1) {
//    set current page to first page
   $currentpage = 1;
} // end if

// the offset of the list, based on current page 
$offset = ($currentpage - 1) * $rowsperpage;
// get the info from the db   

$query = "SELECT ST_XMax(the_geom),ST_XMin(the_geom),ST_YMax(the_geom),ST_YMin(the_geom), gnisname FROM storageres WHERE lower(gnisname) LIKE '%$term%' ORDER BY gnisname LIMIT $rowsperpage OFFSET $offset";
$result = pg_exec($query);

while ($row = pg_fetch_row($result)) {
  $xmax = $row[0];
  $xmin = $row[1];
  $ymax = $row[2];
  $ymin = $row[3];
  $name = $row[4];
echo "<a href=\"javascript:centersearchfeature('".$xmax."','".$xmin."','".$ymax."','".$ymin."');\">".$name."</a><br>";
++$n;
}
paging_links($currentpage,$totalpages, $n);
break;

case 'riv':

$query = "SELECT ST_XMax(the_geom),ST_XMin(the_geom),ST_YMax(the_geom),ST_YMin(the_geom), name FROM rivers WHERE lower(name) LIKE '%$term%' ORDER BY name";
$result = pg_exec($query);
$rows = pg_num_rows($result);
$numrows = $rows; 

// number of rows to show per page
//$rowsperpage = 32;
// find out total pages
$totalpages = ceil($numrows / $rowsperpage);

// get the current page or set a default


if (isset($_POST['current']) && is_numeric($_POST['current'])) {
//    cast var as int
   $currentpage = (int) $_POST['current'];
} else {
//    default page num
   $currentpage = 1;
} // end if

// if current page is greater than total pages...
if ($currentpage > $totalpages) {
//    set current page to last page
   $currentpage = $totalpages;
} // end if
// if current page is less than first page...
if ($currentpage < 1) {
//    set current page to first page
   $currentpage = 1;
} // end if

// the offset of the list, based on current page 
$offset = ($currentpage - 1) * $rowsperpage;
// get the info from the db   

$query = "SELECT ST_XMax(the_geom),ST_XMin(the_geom),ST_YMax(the_geom),ST_YMin(the_geom), name FROM rivers WHERE lower(name) LIKE '%$term%' ORDER BY name LIMIT $rowsperpage OFFSET $offset";
$result = pg_exec($query);

while ($row = pg_fetch_row($result)) {
  $xmax = $row[0];
  $xmin = $row[1];
  $ymax = $row[2];
  $ymin = $row[3];
  $name = $row[4];
echo "<a href=\"javascript:centersearchfeature('".$xmax."','".$xmin."','".$ymax."','".$ymin."');\">".$name."</a><br>";
++$n;
}
paging_links($currentpage,$totalpages, $n);
break;

case 'trs':

$query = "SELECT ST_XMax(the_geom),ST_XMin(the_geom),ST_YMax(the_geom),ST_YMin(the_geom), t_r_s FROM townshiprange WHERE lower(t_r_s) LIKE '%$term%' ORDER BY t_r_s";
$result = pg_exec($query);
$rows = pg_num_rows($result);
$numrows = $rows; 

// number of rows to show per page
//$rowsperpage = 32;
// find out total pages
$totalpages = ceil($numrows / $rowsperpage);

// get the current page or set a default


if (isset($_POST['current']) && is_numeric($_POST['current'])) {
//    cast var as int
   $currentpage = (int) $_POST['current'];
} else {
//    default page num
   $currentpage = 1;
} // end if

// if current page is greater than total pages...
if ($currentpage > $totalpages) {
//    set current page to last page
   $currentpage = $totalpages;
} // end if
// if current page is less than first page...
if ($currentpage < 1) {
//    set current page to first page
   $currentpage = 1;
} // end if

// the offset of the list, based on current page 
$offset = ($currentpage - 1) * $rowsperpage;
// get the info from the db   

$query = "SELECT ST_XMax(the_geom),ST_XMin(the_geom),ST_YMax(the_geom),ST_YMin(the_geom), t_r_s FROM townshiprange WHERE lower(t_r_s) LIKE '%$term%' ORDER BY t_r_s LIMIT $rowsperpage OFFSET $offset";
$result = pg_exec($query);

while ($row = pg_fetch_row($result)) {
  $xmax = $row[0];
  $xmin = $row[1];
  $ymax = $row[2];
  $ymin = $row[3];
  $name = $row[4];
echo "<a href=\"javascript:centersearchfeature('".$xmax."','".$xmin."','".$ymax."','".$ymin."');\">".$name."</a><br>";
++$n;
}
paging_links($currentpage,$totalpages, $n);
break;

case 'rds':

$query = "SELECT ST_XMax(the_geom),ST_XMin(the_geom),ST_YMax(the_geom),ST_YMin(the_geom), road_name FROM roads WHERE lower(road_name) LIKE '%$term%' ORDER BY road_name";
$result = pg_exec($query);
$rows = pg_num_rows($result);
$numrows = $rows; 

// number of rows to show per page
//$rowsperpage = 32;
// find out total pages
$totalpages = ceil($numrows / $rowsperpage);

// get the current page or set a default


if (isset($_POST['current']) && is_numeric($_POST['current'])) {
//    cast var as int
   $currentpage = (int) $_POST['current'];
} else {
//    default page num
   $currentpage = 1;
} // end if

// if current page is greater than total pages...
if ($currentpage > $totalpages) {
//    set current page to last page
   $currentpage = $totalpages;
} // end if
// if current page is less than first page...
if ($currentpage < 1) {
//    set current page to first page
   $currentpage = 1;
} // end if

// the offset of the list, based on current page 
$offset = ($currentpage - 1) * $rowsperpage;
// get the info from the db   

$query = "SELECT ST_XMax(the_geom),ST_XMin(the_geom),ST_YMax(the_geom),ST_YMin(the_geom), road_name FROM roads WHERE lower(road_name) LIKE '%$term%' ORDER BY road_name LIMIT $rowsperpage OFFSET $offset";
$result = pg_exec($query);

while ($row = pg_fetch_row($result)) {
  $xmax = $row[0];
  $xmin = $row[1];
  $ymax = $row[2];
  $ymin = $row[3];
  $name = $row[4];
echo "<a href=\"javascript:centersearchfeature('".$xmax."','".$xmin."','".$ymax."','".$ymin."');\">".$name."</a><br>";
++$n;
}
paging_links($currentpage,$totalpages, $n);
break;

case 'dvid':

$query = "SELECT ST_XMax(the_geom),ST_XMin(the_geom),ST_YMax(the_geom),ST_YMin(the_geom), point_id_new FROM d_point WHERE lower(point_id_new) LIKE '%$term%' ORDER BY point_id_new";
$result = pg_exec($query);
$rows = pg_num_rows($result);
$numrows = $rows; 

// number of rows to show per page
//$rowsperpage = 32;
// find out total pages
$totalpages = ceil($numrows / $rowsperpage);

// get the current page or set a default


if (isset($_POST['current']) && is_numeric($_POST['current'])) {
//    cast var as int
   $currentpage = (int) $_POST['current'];
} else {
//    default page num
   $currentpage = 1;
} // end if

// if current page is greater than total pages...
if ($currentpage > $totalpages) {
//    set current page to last page
   $currentpage = $totalpages;
} // end if
// if current page is less than first page...
if ($currentpage < 1) {
//    set current page to first page
   $currentpage = 1;
} // end if

// the offset of the list, based on current page 
$offset = ($currentpage - 1) * $rowsperpage;
// get the info from the db   

$query = "SELECT ST_XMax(the_geom),ST_XMin(the_geom),ST_YMax(the_geom),ST_YMin(the_geom), point_id_new FROM d_point WHERE lower(point_id_new) LIKE '%$term%' ORDER BY point_id_new LIMIT $rowsperpage OFFSET $offset";
$result = pg_exec($query);

while ($row = pg_fetch_row($result)) {
  $xmax = $row[0];
  $xmin = $row[1];
  $ymax = $row[2];
  $ymin = $row[3];
  $name = $row[4];
echo "<a href=\"javascript:centersearchfeature('".$xmax."','".$xmin."','".$ymax."','".$ymin."');\">".$name."</a><br>";
++$n;
}
paging_links($currentpage,$totalpages, $n);
break;

case 'krdto':

$query = "SELECT ST_XMax(the_geom),ST_XMin(the_geom),ST_YMax(the_geom),ST_YMin(the_geom), turnout FROM turnouts WHERE lower(turnout) LIKE '%$term%' ORDER BY turnout";
$result = pg_exec($query);
$rows = pg_num_rows($result);
$numrows = $rows; 

// number of rows to show per page
//$rowsperpage = 32;
// find out total pages
$totalpages = ceil($numrows / $rowsperpage);

// get the current page or set a default


if (isset($_POST['current']) && is_numeric($_POST['current'])) {
//    cast var as int
   $currentpage = (int) $_POST['current'];
} else {
//    default page num
   $currentpage = 1;
} // end if

// if current page is greater than total pages...
if ($currentpage > $totalpages) {
//    set current page to last page
   $currentpage = $totalpages;
} // end if
// if current page is less than first page...
if ($currentpage < 1) {
//    set current page to first page
   $currentpage = 1;
} // end if

// the offset of the list, based on current page 
$offset = ($currentpage - 1) * $rowsperpage;
// get the info from the db   

$query = "SELECT ST_XMax(the_geom),ST_XMin(the_geom),ST_YMax(the_geom),ST_YMin(the_geom), turnout FROM turnouts WHERE lower(turnout) LIKE '%$term%' ORDER BY turnout LIMIT $rowsperpage OFFSET $offset";
$result = pg_exec($query);

while ($row = pg_fetch_row($result)) {
  $xmax = $row[0];
  $xmin = $row[1];
  $ymax = $row[2];
  $ymin = $row[3];
  $name = $row[4];
echo "<a href=\"javascript:centersearchfeature('".$xmax."','".$xmin."','".$ymax."','".$ymin."');\">".$name."</a><br>";
++$n;
}
paging_links($currentpage,$totalpages, $n);
break;

case 'krddl':

$query = "SELECT ST_XMax(the_geom),ST_XMin(the_geom),ST_YMax(the_geom),ST_YMin(the_geom), name FROM canals WHERE lower(name) LIKE '%$term%' ORDER BY name";
$result = pg_exec($query);
$rows = pg_num_rows($result);
$numrows = $rows; 

// number of rows to show per page
//$rowsperpage = 32;
// find out total pages
$totalpages = ceil($numrows / $rowsperpage);

// get the current page or set a default


if (isset($_POST['current']) && is_numeric($_POST['current'])) {
//    cast var as int
   $currentpage = (int) $_POST['current'];
} else {
//    default page num
   $currentpage = 1;
} // end if

// if current page is greater than total pages...
if ($currentpage > $totalpages) {
//    set current page to last page
   $currentpage = $totalpages;
} // end if
// if current page is less than first page...
if ($currentpage < 1) {
//    set current page to first page
   $currentpage = 1;
} // end if

// the offset of the list, based on current page 
$offset = ($currentpage - 1) * $rowsperpage;
// get the info from the db   

$query = "SELECT ST_XMax(the_geom),ST_XMin(the_geom),ST_YMax(the_geom),ST_YMin(the_geom), name FROM canals WHERE lower(name) LIKE '%$term%' ORDER BY name LIMIT $rowsperpage OFFSET $offset";
$result = pg_exec($query);

while ($row = pg_fetch_row($result)) {
  $xmax = $row[0];
  $xmin = $row[1];
  $ymax = $row[2];
  $ymin = $row[3];
  $name = $row[4];
echo "<a href=\"javascript:centersearchfeature('".$xmax."','".$xmin."','".$ymax."','".$ymin."');\">".$name."</a><br>";
++$n;
}
paging_links($currentpage,$totalpages, $n);
break;

case 'hydrost':

$query = "SELECT ST_XMax(the_geom),ST_XMin(the_geom),ST_YMax(the_geom),ST_YMin(the_geom), site_name FROM hydrostations WHERE lower(site_name) LIKE '%$term%' ORDER BY site_name";
$result = pg_exec($query);
$rows = pg_num_rows($result);
$numrows = $rows; 

// number of rows to show per page
//$rowsperpage = 32;
// find out total pages
$totalpages = ceil($numrows / $rowsperpage);

// get the current page or set a default


if (isset($_POST['current']) && is_numeric($_POST['current'])) {
//    cast var as int
   $currentpage = (int) $_POST['current'];
} else {
//    default page num
   $currentpage = 1;
} // end if

// if current page is greater than total pages...
if ($currentpage > $totalpages) {
//    set current page to last page
   $currentpage = $totalpages;
} // end if
// if current page is less than first page...
if ($currentpage < 1) {
//    set current page to first page
   $currentpage = 1;
} // end if

// the offset of the list, based on current page 
$offset = ($currentpage - 1) * $rowsperpage;
// get the info from the db   

$query = "SELECT ST_XMax(the_geom),ST_XMin(the_geom),ST_YMax(the_geom),ST_YMin(the_geom), site_name FROM hydrostations WHERE lower(site_name) LIKE '%$term%' ORDER BY site_name LIMIT $rowsperpage OFFSET $offset";
$result = pg_exec($query);

while ($row = pg_fetch_row($result)) {
  $xmax = $row[0];
  $xmin = $row[1];
  $ymax = $row[2];
  $ymin = $row[3];
  $name = $row[4];
echo "<a href=\"javascript:centersearchfeature('".$xmax."','".$xmin."','".$ymax."','".$ymin."');\">".$name."</a><br>";
++$n;
}
paging_links($currentpage,$totalpages, $n);
break;

case 'wrid':

$query = "SELECT ST_XMax(the_geom),ST_XMin(the_geom),ST_YMax(the_geom),ST_YMin(the_geom), wr_doc_id2 FROM pou_new WHERE lower(wr_doc_id2) LIKE '%$term%' ORDER BY wr_doc_id2";
$result = pg_exec($query);
$rows = pg_num_rows($result);
$numrows = $rows; 

// number of rows to show per page
//$rowsperpage = 32;
// find out total pages
$totalpages = ceil($numrows / $rowsperpage);

// get the current page or set a default


if (isset($_POST['current']) && is_numeric($_POST['current'])) {
//    cast var as int
   $currentpage = (int) $_POST['current'];
} else {
//    default page num
   $currentpage = 1;
} // end if

// if current page is greater than total pages...
if ($currentpage > $totalpages) {
//    set current page to last page
   $currentpage = $totalpages;
} // end if
// if current page is less than first page...
if ($currentpage < 1) {
//    set current page to first page
   $currentpage = 1;
} // end if

// the offset of the list, based on current page 
$offset = ($currentpage - 1) * $rowsperpage;
// get the info from the db   

$query = "SELECT ST_XMax(the_geom),ST_XMin(the_geom),ST_YMax(the_geom),ST_YMin(the_geom), wr_doc_id2 FROM pou_new WHERE lower(wr_doc_id2) LIKE '%$term%' ORDER BY wr_doc_id2 LIMIT $rowsperpage OFFSET $offset";
$result = pg_exec($query);

while ($row = pg_fetch_row($result)) {
  $xmax = $row[0];
  $xmin = $row[1];
  $ymax = $row[2];
  $ymin = $row[3];
  $name = $row[4];
echo "<a href=\"javascript:centersearchfeature('".$xmax."','".$xmin."','".$ymax."','".$ymin."');\">".$name."</a><br>";
++$n;
}
paging_links($currentpage,$totalpages, $n);
break;

case 'wrid2':

$query = "SELECT ST_XMax(the_geom),ST_XMin(the_geom),ST_YMax(the_geom),ST_YMin(the_geom), wr_doc_nr FROM pou_new WHERE lower(wr_doc_nr) LIKE '%$term%' ORDER BY wr_doc_nr";
$result = pg_exec($query);
$rows = pg_num_rows($result);
$numrows = $rows; 

// number of rows to show per page
//$rowsperpage = 32;
// find out total pages
$totalpages = ceil($numrows / $rowsperpage);

// get the current page or set a default


if (isset($_POST['current']) && is_numeric($_POST['current'])) {
//    cast var as int
   $currentpage = (int) $_POST['current'];
} else {
//    default page num
   $currentpage = 1;
} // end if

// if current page is greater than total pages...
if ($currentpage > $totalpages) {
//    set current page to last page
   $currentpage = $totalpages;
} // end if
// if current page is less than first page...
if ($currentpage < 1) {
//    set current page to first page
   $currentpage = 1;
} // end if

// the offset of the list, based on current page 
$offset = ($currentpage - 1) * $rowsperpage;
// get the info from the db   

$query = "SELECT ST_XMax(the_geom),ST_XMin(the_geom),ST_YMax(the_geom),ST_YMin(the_geom), wr_doc_nr FROM pou_new WHERE lower(wr_doc_nr) LIKE '%$term%' ORDER BY wr_doc_nr LIMIT $rowsperpage OFFSET $offset";
$result = pg_exec($query);

while ($row = pg_fetch_row($result)) {
  $xmax = $row[0];
  $xmin = $row[1];
  $ymax = $row[2];
  $ymin = $row[3];
  $name = $row[4];
echo "<a href=\"javascript:centersearchfeature('".$xmax."','".$xmin."','".$ymax."','".$ymin."');\">".$name."</a><br>";
++$n;
}
paging_links($currentpage,$totalpages, $n);
break;



}

function paging_links($currentpage, $totalpages, $rownumber) {

if($rownumber == 0)
{
echo "No search results found.";
}
else
{
///******  build the page links ******/

echo "<br>";
// range of num links to show
$range = 2;

// if not on page 1, don't show back links
if ($currentpage > 1) {

//    get previous page num
   $prevpage = $currentpage - 1;
 //   show < link to go back to 1 page
   echo "<a href=\"javascript:ajax_search($prevpage)\">Previous</a> ";
} // end if 

// loop to show links to range of pages around current page
for ($x = ($currentpage - $range); $x < (($currentpage + $range) + 1); $x++) {
   // if it's a valid page number...
   if (($x > 0) && ($x <= $totalpages)) {
      // if we're on current page...
      if ($x == $currentpage) {
         // 'highlight' it but don't make a link
         echo "[$x]&nbsp;";
      // if not current page...
      } else {
         // make it a link

         echo "<a href=\"javascript:ajax_search($x);\">".$x."&nbsp;</a>";
      } // end else
   } // end if 
} // end for
                 
// if not on last page, show forward and last page links        
if ($currentpage != $totalpages) {
   // get next page
   $nextpage = $currentpage + 1;
    // echo forward link for next page 
   echo "<a href=\"javascript:ajax_search($nextpage)\"> Next</a> ";

} // end if
echo "<br>&nbsp;";

}
}

function sanitize($string){
$string = preg_replace('/\s\s+/', ' ', $string);
$string = trim($string);
$string = filter_var($string, FILTER_SANITIZE_SPECIAL_CHARS);
return $string;
}

?>