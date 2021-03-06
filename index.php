<?php

/**
 * ROF Statistics
 *
 * @package    report
 * @subpackage up1rofstats
 * @copyright  2012-2014 Silecs {@link http://www.silecs.info/societe}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

define('NO_OUTPUT_BUFFERING', true);

require('../../config.php');
require_once($CFG->dirroot.'/report/up1rofstats/locallib.php');
require_once($CFG->dirroot.'/local/roftools/rofcourselib.php');
require_once($CFG->libdir.'/adminlib.php');

require_login();

// $issue = optional_param('issue', '', PARAM_ALPHANUMEXT); // show detailed info about one issue only

// Print the header.
admin_externalpage_setup('reportup1rofstats', '', null, '', array('pagelayout'=>'report'));
echo $OUTPUT->header();

echo $OUTPUT->heading(get_string('pluginname', 'report_up1rofstats'));

$url = "$CFG->wwwroot/report/up1rofstats/index.php";

$browserurl = "$CFG->wwwroot/local/rof_browser/rof_browser.php";
echo '<div><a href="' . $browserurl. '">ROF browser</a></div>';


echo "<h3>Compteurs</h3>\n";
$table = new html_table();
$table->head = array('Items', 'Nb');
$table->data = report_up1rofstats_generic();
echo html_writer::table($table);

echo rof_links_constants('/report/up1rofstats/constant.php');

echo "<h3>Composantes</h3>\n";
$table = new html_table();
$table->head = array('', '# Programmes', 'Id. ROF', 'Nom');
$table->data = report_up1rofstats_components();
echo html_writer::table($table);

echo "<h3>Cours ROF</h3>\n";
$table = new html_table();
$table->head = array('Items', 'Nb');
$table->data = report_up1rofstats_courses();
echo html_writer::table($table);

echo "<h3>Personnes</h3>\n";
$table = new html_table();
$table->head = array('Niveaux', 'Personnes non vides');
$table->data = report_up1rofstats_persons_not_empty();
echo html_writer::table($table);


echo "<h2>Anomalies ?</h2>";

echo "<h3>Programmes hybrides</h3>\n";
$table = new html_table();
$table->head = array('Programme', 'Titre', 'ss-prog.', 'cours');
$table->data = report_up1rofstats_hybrid_programs();
echo html_writer::table($table);

echo "<h3>Noms locaux</h3>\n";
$table = new html_table();
$table->head = array('Objet', 'ROFid', 'Nom ROF', 'Nom local');
$table->data = report_up1rofstats_localname_not_empty();
echo html_writer::table($table);

echo "<h3>Références cassées</h3>";
echo "<p>Liste les cours faisant référence à un objet ROF absent des tables de cache ROF.</p>";
rof_check_courses_references();

/*  $table->head  = array($strissue, $strstatus, $strdesc, $strconfig);
    $table->size  = array('30%', '10%', '50%', '10%' );
    $table->align = array('left', 'left', 'left', 'left');
    $table->attributes = array('class'=>'scurityreporttable generaltable');
    $table->data  = array();
    $table->data[] = $row;
*/

echo '<div><a href="' . $browserurl. '">ROF browser</a></div>';

echo $OUTPUT->footer();
