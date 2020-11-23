<?php
class FckHelper extends HtmlHelper {
    function load($id, $toolbar = 'Default') {
        $did = Inflector::camelize(str_replace('.', '_', $id));
        $js = $this->webroot.'js/';
        $output = '';
		$output .= "<script type=\"text/javascript\">\n";
		$output .= "	fckLoader_$did = function () {\n";
		$output .= "		var bFCKeditor_$did = new FCKeditor('$did', 650, 500);\n";
		$output .= "		bFCKeditor_$did.BasePath = '$js';\n";
		$output .= "		bFCKeditor_$did.ToolbarSet = '$toolbar';\n";
		$output .= "		bFCKeditor_$did.ReplaceTextarea();\n";
		$output .= "	}\n";
		$output .= "	fckLoader_$did();\n";
		$output .= "</script>";

		return $output;
    }
}
?>