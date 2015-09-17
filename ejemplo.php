<?php
	
	require_once 'tcpdf/tcpdf.php';

	$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, 'A4', true, 'UTF-8', false);

	// establecemos la información del documento
	$pdf->SetCreator(PDF_CREATOR);
	$pdf->SetAuthor('Geektlan');
	$pdf->SetTitle('Ejemplo de pdf');
	$pdf->SetSubject('Creando un PDF con PHP y TCPDF');
	$pdf->SetKeywords('TCPDF, Geektlan, PHP, Fácil, Comunidad');

	// establecemos los datos del encabezado que tendrán las páginas del PDF
	$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

	// establecemos el tipo de letra que se ocupara en el encabezado y píe de página
	$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
	$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

	// establecemos la medida del interlineado
	$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

	// establecemos las medidas de los margenes
	$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
	$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
	$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

	/* establecemos que haga un salto de página cada vez que el contenido del PDF sobre
	   pase el límite del margen inferior */
	$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

	/* establecemos que ajuste las imagenes cuando sea muy grande y se salga de los límites
	   de los margenes */
	$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

	// agregamos una página
	$pdf->AddPage();

	// creando algún contenido HTML
	$html = '<h1>HTML Example</h1>
	Some special characters: &lt; € &euro; &#8364; &amp; è &egrave; &copy; &gt; \\slash \\\\double-slash \\\\\\triple-slash
	<h2>List</h2>
	List example:
	<ol>
	    <li><img src="images/logo_example.png" alt="test alt attribute" width="30" height="30" border="0" /> test image</li>
	    <li><b>bold text</b></li>
	    <li><i>italic text</i></li>
	    <li><u>underlined text</u></li>
	    <li><b>b<i>bi<u>biu</u>bi</i>b</b></li>
	    <li><a href="http://www.tecnick.com" dir="ltr">link to http://www.tecnick.com</a></li>
	    <li>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.<br />Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.</li>
	    <li>SUBLIST
	        <ol>
	            <li>row one
	                <ul>
	                    <li>sublist</li>
	                </ul>
	            </li>
	            <li>row two</li>
	        </ol>
	    </li>
	    <li><b>T</b>E<i>S</i><u>T</u> <del>line through</del></li>
	    <li><font size="+3">font + 3</font></li>
	    <li><small>small text</small> normal <small>small text</small> normal <sub>subscript</sub> normal <sup>superscript</sup> normal</li>
	</ol>
	<dl>
	    <dt>Coffee</dt>
	    <dd>Black hot drink</dd>
	    <dt>Milk</dt>
	    <dd>White cold drink</dd>
	</dl>
	<div style="text-align:center">IMAGES<br />
	<img src="images/logo_example.png" alt="test alt attribute" width="100" height="100" border="0" /><img src="images/tcpdf_box.svg" alt="test alt attribute" width="100" height="100" border="0" /><img src="images/logo_example.jpg" alt="test alt attribute" width="100" height="100" border="0" />
	</div>';

	// agregando el contenido HTML al PDF.
	$pdf->writeHTML($html, true, false, true, false, '');

	// agregamos una página
	$pdf->AddPage();

	// creando más contenido HTML
	$subtable = '<table border="1" cellspacing="6" cellpadding="4"><tr><td>a</td><td>b</td></tr><tr><td>c</td><td>d</td></tr></table>';

	$html = '<h2>HTML TABLE:</h2>
	<table border="1" cellspacing="3" cellpadding="4">
	    <tr>
	        <th>#</th>
	        <th align="right">RIGHT align</th>
	        <th align="left">LEFT align</th>
	        <th>4A</th>
	    </tr>
	    <tr>
	        <td>1</td>
	        <td bgcolor="#cccccc" align="center" colspan="2">A1 ex<i>amp</i>le <a href="http://www.tcpdf.org">link</a> column span. One two tree four five six seven eight nine ten.<br />line after br<br /><small>small text</small> normal <sub>subscript</sub> normal <sup>superscript</sup> normal  bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla<ol><li>first<ol><li>sublist</li><li>sublist</li></ol></li><li>second</li></ol><small color="#FF0000" bgcolor="#FFFF00">small small small small small small small small small small small small small small small small small small small small</small></td>
	        <td>4B</td>
	    </tr>
	    <tr>
	        <td>'.$subtable.'</td>
	        <td bgcolor="#0000FF" color="yellow" align="center">A2 € &euro; &#8364; &amp; è &egrave;<br/>A2 € &euro; &#8364; &amp; è &egrave;</td>
	        <td bgcolor="#FFFF00" align="left"><font color="#FF0000">Red</font> Yellow BG</td>
	        <td>4C</td>
	    </tr>
	    <tr>
	        <td>1A</td>
	        <td rowspan="2" colspan="2" bgcolor="#FFFFCC">2AA<br />2AB<br />2AC</td>
	        <td bgcolor="#FF0000">4D</td>
	    </tr>
	    <tr>
	        <td>1B</td>
	        <td>4E</td>
	    </tr>
	    <tr>
	        <td>1C</td>
	        <td>2C</td>
	        <td>3C</td>
	        <td>4F</td>
	    </tr>
	</table>';

	// agregando el contenido HTML al PDF.
	$pdf->writeHTML($html, true, false, true, false, '');


	//Cerramos y generamos el PDF
	$pdf->Output('Ejemplo1.pdf', 'I');

	exit;