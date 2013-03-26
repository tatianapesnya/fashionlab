<?php

if(isset($_POST['id']) && $id==$_POST['id']) {
	
	echo '<h3>Super slider '.$_POST['id'].' updated.</h3>';
}
?>
<style>

.addwindow {
	
	position:relative:
	border: 2px;
	display: none;
	
}
.superitemfull<?php echo $id; ?> {
	
	margin: 10px;
	padding: 10px;
	
	
	display: none;
	
}


.superdelete<?php echo $id; ?>{
	
	
	display: none;
	
}
.edititem {
	
	position:relative:
	border: 2px;
	display: none;
	margin: 8px;
	line-height:250%;
	padding: 8px;
	background-color:#CCC;
	
}
</style>
    <script type="text/javascript">

        jQuery(document).ready( function () { 
		
		
		var uploadID<?php echo $id; ?> = ''; /*setup the var in a global scope*/

jQuery('.upload-button<?php echo $id; ?>').click(function() {
	
	

//uploadID = jQuery(this).prev('input');
uploadID<?php echo $id; ?> = jQuery(this).prev('input');


window.send_to_editor = function(html) {

var textt=html;


if(textt.search("img")!=-1) imgurl = jQuery('img',html).attr('src');

else {

	imgurl = jQuery(html).attr('href');

}

uploadID<?php echo $id; ?>.val(imgurl)
tb_remove();
}


tb_show('', 'media-upload.php?type=image&amp;amp;amp;amp;TB_iframe=true&uploadID<?php echo $id; ?>=' + uploadID<?php echo $id; ?>);

return false;
});



		
		
          
	jQuery('.editsupera<?php echo $id; ?>').click(function() {
		
		
	if(jQuery('#supersliderconfiga<?php echo $id; ?>').css("display")=="none") {
		
		jQuery('#ideditsupera<?php echo $id; ?>').removeClass("button-secondary").addClass("button-primary");
		
				
		jQuery('#ideditsuperb<?php echo $id; ?>').removeClass("button-primary").addClass("button-secondary");
		jQuery('#ideditsuperc<?php echo $id; ?>').removeClass("button-primary").addClass("button-secondary");
		
		jQuery('.superitemfull<?php echo $id; ?>').show();
		jQuery('#supersliderconfiga<?php echo $id; ?>').show();
		jQuery('#supersliderconfigb<?php echo $id; ?>').css("display", "none");
		jQuery('#supersliderconfigc<?php echo $id; ?>').css("display", "none");
	}
	else {
		jQuery('#ideditsupera<?php echo $id; ?>').removeClass("button-primary").addClass("button-secondary");
		jQuery('#ideditsuperb<?php echo $id; ?>').removeClass("button-primary").addClass("button-secondary");
		jQuery('#ideditsuperc<?php echo $id; ?>').removeClass("button-primary").addClass("button-secondary");
		jQuery('.superitemfull<?php echo $id; ?>').css("display", "none");
		jQuery('#supersliderconfiga<?php echo $id; ?>').css("display", "none");
		jQuery('#supersliderconfigb<?php echo $id; ?>').css("display", "none");
		jQuery('#supersliderconfigc<?php echo $id; ?>').css("display", "none");
	}
	
	
	
	
	return false;
	
	
})

jQuery('.editsuperb<?php echo $id; ?>').click(function() {
		
		
	if(jQuery('#supersliderconfigb<?php echo $id; ?>').css("display")=="none") {
		jQuery('#ideditsuperb<?php echo $id; ?>').removeClass("button-secondary").addClass("button-primary");
		
				jQuery('#ideditsupera<?php echo $id; ?>').removeClass("button-primary").addClass("button-secondary");
		
		jQuery('#ideditsuperc<?php echo $id; ?>').removeClass("button-primary").addClass("button-secondary");
		jQuery('.superitemfull<?php echo $id; ?>').show();
		jQuery('#supersliderconfigb<?php echo $id; ?>').show();
		jQuery('#supersliderconfiga<?php echo $id; ?>').css("display", "none");
		jQuery('#supersliderconfigc<?php echo $id; ?>').css("display", "none");
	}
	else {
		jQuery('#ideditsupera<?php echo $id; ?>').removeClass("button-primary").addClass("button-secondary");
		jQuery('#ideditsuperb<?php echo $id; ?>').removeClass("button-primary").addClass("button-secondary");
		jQuery('#ideditsuperc<?php echo $id; ?>').removeClass("button-primary").addClass("button-secondary");
		jQuery('.superitemfull<?php echo $id; ?>').css("display", "none");
		
		jQuery('#supersliderconfiga<?php echo $id; ?>').css("display", "none");
		jQuery('#supersliderconfigb<?php echo $id; ?>').css("display", "none");
		jQuery('#supersliderconfigc<?php echo $id; ?>').css("display", "none");
	}
	
	
	
	
	return false;
	
	
})

jQuery('.editsuperc<?php echo $id; ?>').click(function() {
		
		
	if(jQuery('#supersliderconfigc<?php echo $id; ?>').css("display")=="none") {
		jQuery('#ideditsuperc<?php echo $id; ?>').removeClass("button-secondary").addClass("button-primary");
				jQuery('#ideditsupera<?php echo $id; ?>').removeClass("button-primary").addClass("button-secondary");
		jQuery('#ideditsuperb<?php echo $id; ?>').removeClass("button-primary").addClass("button-secondary");
		
		jQuery('.superitemfull<?php echo $id; ?>').show();
		jQuery('#supersliderconfigc<?php echo $id; ?>').show();
		jQuery('#supersliderconfigb<?php echo $id; ?>').css("display", "none");
		jQuery('#supersliderconfiga<?php echo $id; ?>').css("display", "none");
	}
	else {
		jQuery('#ideditsupera<?php echo $id; ?>').removeClass("button-primary").addClass("button-secondary");
		jQuery('#ideditsuperb<?php echo $id; ?>').removeClass("button-primary").addClass("button-secondary");
		jQuery('#ideditsuperc<?php echo $id; ?>').removeClass("button-primary").addClass("button-secondary");
		jQuery('.superitemfull<?php echo $id; ?>').css("display", "none");
		jQuery('#supersliderconfiga<?php echo $id; ?>').css("display", "none");
		jQuery('#supersliderconfigb<?php echo $id; ?>').css("display", "none");
		jQuery('#supersliderconfigc<?php echo $id; ?>').css("display", "none");
	}
	
	
	
	
	return false;
	
	
})
	

	jQuery('.deletebuton<?php echo $id; ?>').click(function() {
		
		
		
			if(jQuery('.superdelete<?php echo $id; ?>').css("display")=="none") jQuery('.superdelete<?php echo $id; ?>').show();
	else jQuery('.superdelete<?php echo $id; ?>').css("display", "none")
		

	
	
	
	return false;
	
	
})	
		 
	jQuery('.additem').click(function() {
		
		
		
	//jQuery('.widget-wp_super-__i__-savewidget').trigger('click');
	jQuery('input[name=operation]').val('1');
	jQuery('.addwindow').show();
	
	
	
	return false;
	
	
})

	jQuery('.deleteitem').click(function() {
		
		
		
	//jQuery('.widget-wp_super-__i__-savewidget').trigger('click');
	jQuery('input[name=operation]').val('2');
	jQuery('.addwindow').show();
	
	
	
	return false;
	
	
})

	jQuery('.cancel').click(function() {
		
		
		
	//jQuery('.widget-wp_super-__i__-savewidget').trigger('click');
	jQuery('input[name=operation]').val('0');
	jQuery('.addwindow').hide();
	
	
	
	return false;
	
	
})

jQuery('.<?php echo $id; ?>editbutton').click(function() {
		
		
		
	//jQuery('.widget-wp_super-__i__-savewidget').trigger('click');
	

	if(jQuery('#<?php echo $id; ?>edit'+jQuery(this).attr("rel")).css("display")=="none") { 
		
		jQuery('#<?php echo $id; ?>edit'+jQuery(this).attr("rel")).show()
		jQuery(this).text("-")
	}
	else { 
		jQuery(this).text(' Edit ')
		jQuery('#<?php echo $id; ?>edit'+jQuery(this).attr("rel")).css("display", "none")
	}
	return false;
	
	
})

		  
        });
		
		
function super_selector<?php echo $id; ?>(xx)
{
if(xx==1)document.getElementById("super_selectortxt<?php echo $id; ?>").select();
else document.getElementById("super_selectortxtc<?php echo $id; ?>").select();
}


    </script>
   
    
    <tr>
    <th id="columnname" class="manage-column column-columnname" scope="col" ><h2><?php echo $id; ?></h2> 
    </th>
    <th id="columnname" class="manage-column column-columnname" scope="col">  
    
    <table>
    <tr>
    <td><div id="icon-upload" class="icon32"></div>
    </td>
    <td><div id="icon-options-general" class="icon32"></div>
    </td>
    <td><div id="icon-tools" class="icon32"></div>
    </td>
    </tr>
    
        <tr>
    <td><button id="ideditsupera<?php echo $id; ?>" class="button-secondary editsupera<?php echo $id; ?>"><h4>Images</h4></button>
    </td>
    <td><button id="ideditsuperb<?php echo $id; ?>" class="button-secondary editsuperb<?php echo $id; ?>"><h4>Settings</h4></button>
    </td>
    <td><button id="ideditsuperc<?php echo $id; ?>" class="button-secondary editsuperc<?php echo $id; ?>"><h4>Effects</h4></button>
    </td>
    </tr>
    </table>          
      
    
     
    </th>
     <th id="columnname" class="manage-column column-columnname" scope="col">  
    <input type="text"  id="super_selectortxtc<?php echo $id; ?>" name="super_selectortxtc<?php echo $id; ?>" onclick="super_selector<?php echo $id; ?>(0);" value="[super <?php echo $id; ?> /]" readonly /> 
    </th>
     <th id="columnname" class="manage-column column-columnname" scope="col">  
    <legend>Widget "super video" with <?php echo $id; ?> slider.</legend> 
    </th>
     <th id="columnname" class="manage-column column-columnname" scope="col">  
    <textarea readonly rows="5" style="width:100%" id="super_selectortxt<?php echo $id; ?>" name="super_selectortxt<?php echo $id; ?>" onclick="super_selector<?php echo $id; ?>(1);">
    <?php 
	
	echo super_render2("[super ".$id." /]");
	
	?>
    </textarea>
     
    </th>
    
    <th id="columnname" class="manage-column column-columnname" scope="col">  
    
    <form method="post" action="">
	  <input name="borrar" type="hidden" id="borrar" value="<?php echo $id; ?>">
     
      
      <button class="button-secondary deletebuton<?php echo $id; ?>"><h3>Delete</h3></button>
      <div class="superdelete<?php echo $id; ?>">
      <button class="deletebuton<?php echo $id; ?>">CANCEL</button>
     <input type='submit' name='' value='OK' />
     </div>
    </form>
    </th>
   
    </tr>
   
   
<tr>
<td colspan="6" bgcolor="#FFFFFF">


<div class="superitemfull<?php echo $id; ?>" > 
	<form method="post" action="">
		<fieldset>

             
              
              <div id="supersliderconfiga<?php echo $id; ?>" style="display:none;">
              
              <div id="icon-upload" class="icon32"><br /></div><h2>Images</h2><br/>
             
              <input name="operation" type="hidden" id="operation" value="0" />
               <input name="itemselect<?php echo $id; ?>" type="hidden" id="itemselect<?php echo $id; ?>" value="" />
             
            <button class="button-primary additem">New image</button> <button class="button-secondary deleteitem">Delete images</button> 
            <div class="addwindow">
             <hr />
           <input type='submit' name='' value='OK' /><button class="button-secondary cancel">Cancel</button>
            
            </div>
            
            <ul>
            <?php
			
			// items
			$cont=0;
			if($values!="") {
				$items=explode("kh6gfd57hgg", $values);
				$cont=1;
				foreach ($items as &$value) {
					if(count($items)>$cont) {
					$item=explode("t6r4nd", $value);
					
					 
					 echo '<li> <input name="item'.$cont.'" type="checkbox" value="hide" /> <img src="'.$item[2].'" width="60px"/> <input name="title'.$cont.'" type="text" value="'.$item[0].'" size="100"/> <button class="'.$id.'editbutton" rel="'.$cont.'"> Edit </button>
					 
					 <div id="'.$id.'edit'.$cont.'" class="edititem">
					  Image url:<br/>
					 <input type="text" name="image'.$cont.'" value="'.$item[2].'" class="upload'.$id.'" size="70"/>
					 <input class="upload-button'.$id.'" name="wsl-image-add" type="button" value="SELECT IMAGE" /><br/>
					Link url:<br/>
					<input name="video'.$cont.'" type="text" value="'.$item[4].'"  size="70" /> <br/>
					
					 Description:<br/><textarea name="description'.$cont.'" rows="5" cols="80" id="description'.$cont.'" >'.$item[1].'</textarea><br/>
					
					  Active: <input name="link'.$cont.'" type="checkbox" id="link'.$cont.'" value="1"';
					 
					 if($item[3]=="1") echo 'checked="checked"';
					 
					 echo ' /><br/>
					 ORDER: <input name="order'.$cont.'" type="text" value="'.$cont.'" size="4"/><br/>
					  <hr />
					  <input type=\'submit\' name=\'\' value=\'Save\' class="button-primary" />
					 </div>
					 </li>';
					 $cont++;
					}
					 
				}
			}
			 $cont--;
			echo '</ul><input class="widefat" name="total" type="hidden" id="total" value="'.$cont.'" />';
			
	
			
			
			?>
 
 </div>
          
            
             <div id="supersliderconfigb<?php echo $id; ?>" style="display:none;">
             
             <div id="icon-options-general" class="icon32"><br /></div><h2>Settings</h2>


<table class="form-table">

<tr valign="top">
<th scope="row"><label for="blogname">Title</label></th>
<td><input id="stitle<?php echo $id; ?>" name="stitle<?php echo $id; ?>" type="text" size="100" value="<?php echo $title; ?>" /></td>
</tr>

<tr valign="top">
<th scope="row"><label for="blogname">Max Plugin width</label></th>
<td><input type='text' id='width<?php echo $id; ?>'  name='width<?php echo $id; ?>'  value='<?php echo $width; ?>' size="6"/>
<p class="description">Number.</p></td>
</tr>

<tr valign="top">
<th scope="row"><label for="blogname">Max Plugin height</label></th>
<td><input type='text' id='height<?php echo $id; ?>'  name='height<?php echo $id; ?>'  value='<?php echo $height; ?>' size="6"/>
<p class="description">Number.</p></td>
</tr>


<tr valign="top">
<th scope="row"><label for="blogname">Max Plugin width in mobiles</label></th>
<td><input type='text' id='tborder<?php echo $id; ?>'  name='tborder<?php echo $id; ?>'  value='<?php echo $tborder; ?>' size="6"/>
<p class="description">Number.</p></td>
</tr>

<tr valign="top">
<th scope="row"><label for="blogname">Max Plugin height in mobiles</label></th>
<td><input type='text' id='font<?php echo $id; ?>'  name='font<?php echo $id; ?>'  value='<?php echo $font; ?>' size="6"/>
<p class="description">Number.</p></td>
</tr>

<tr valign="top">
<th scope="row"><label for="blogname">Max Plugin width in tablet</label></th>
<td><input type='text' id='color1<?php echo $id; ?>'  name='color1<?php echo $id; ?>'  value='<?php echo $color1; ?>' size="6"/>
<p class="description">Number.</p></td>
</tr>

<tr valign="top">
<th scope="row"><label for="blogname">Max Plugin height in tablet</label></th>
<td><input type='text' id='color2<?php echo $id; ?>'  name='color2<?php echo $id; ?>'  value='<?php echo $color2; ?>' size="6"/>
<p class="description">Number.</p></td>
</tr>


<tr valign="top">
<th scope="row"><label for="blogname">Transition time</label></th>
<td><input type='text' id='border<?php echo $id; ?>'  name='border<?php echo $id; ?>'  value='<?php echo $border; ?>' size="6"/>
<p class="description">Number in milliseconds.</p></td>
</tr>

<tr valign="top">
<th scope="row"><label for="blogname">Animation time</label></th>
<td><input type='text' id='op4<?php echo $id; ?>'  name='op4<?php echo $id; ?>'  value='<?php echo $op4; ?>' size="6"/>
<p class="description">Number in milliseconds.</p></td>
</tr>


<tr valign="top">
<th scope="row"><label for="blogname">Border size</label></th>
<td><input type='text' id='color3<?php echo $id; ?>'  name='color3<?php echo $id; ?>'  value='<?php echo $color3; ?>' size="6"/>
<p class="description">Number in pixels.</p></td>
</tr>






<tr valign="top">
<th scope="row"><label for="blogname">Navegation</label></th>
<td> <select name="number_thumbnails<?php echo $id; ?>" id="number_thumbnails<?php echo $id; ?>">
			        <option value="true" <?php if($number_thumbnails=="true" || $number_thumbnails=="") echo ' selected="selected"'; ?>>True</option>
                     <option value="false" <?php if($number_thumbnails=="false") echo ' selected="selected"'; ?>>False</option>
			        
			       

		          </select></td>
</tr>
<tr valign="top">
<th scope="row"><label for="blogname">Navegation placement</label></th>
<td>			      
<select name="op3<?php echo $id; ?>" id="op3<?php echo $id; ?>">
			        <option value="inside" <?php if($op3=="inside" || $op3=="") echo ' selected="selected"'; ?>>Inside</option>
                     <option value="outside" <?php if($op3=="outside") echo ' selected="selected"'; ?>>Outside</option>
			        
			       

		          </select></td>
</tr>
<tr valign="top">
<th scope="row"><label for="blogname">Show Thumbnails?</label></th>
<td><select name="op1<?php echo $id; ?>" id="op1<?php echo $id; ?>">
			        <option value="true" <?php if($op1=="true" || $op1=="") echo ' selected="selected"'; ?>>True</option>
                     <option value="false" <?php if($op1=="false") echo ' selected="selected"'; ?>>False</option>
			        
			       

		    </select>     </td>
</tr>


<tr valign="top">
<th scope="row"><label for="blogname">Show next prev?</label></th>
<td> <select name="sizetitle<?php echo $id; ?>" id="sizetitle<?php echo $id; ?>">
			        <option value="false" <?php if($sizetitle=="false") echo ' selected="selected"'; ?>>False</option>
			        <option value="true" <?php if($sizetitle!="false") echo ' selected="selected"'; ?>>True</option>
		          </select>
                  
			      </td>
</tr>
<tr valign="top">
<th scope="row"><label for="blogname">Text align</label></th>
<td> <select name="op2<?php echo $id; ?>" id="op2<?php echo $id; ?>">
			        <option value="left" <?php if($op2=="left" || $op2=="") echo ' selected="selected"'; ?>>Left</option>
                    
			        <option value="right" <?php if($op2=="right") echo ' selected="selected"'; ?>>Right</option>
                     <option value="top" <?php if($op2=="top") echo ' selected="selected"'; ?>>Top</option>
                     <option value="bottom" <?php if($op2=="bottom") echo ' selected="selected"'; ?>>Bottom</option>
			       

		          </select></td>
</tr>
<tr valign="top">
<th scope="row"><label for="blogname">Link target</label></th>
<td><input type='text' id='thumbnail_round<?php echo $id; ?>'  name='thumbnail_round<?php echo $id; ?>'  value='<?php echo $thumbnail_round; ?>' size="12"/></td>
</tr>


<?php

/*

<tr valign="top">
<th scope="row"><label for="blogname">SLIDER DESIGN</label></th>
<td>		      <select name="time<?php echo $id; ?>" id="time<?php echo $id; ?>">
			        <option value="1" <?php if($time=="1" || $time=="") echo ' selected="selected"'; ?>>Black design</option>
                    
			        <option value="2" <?php if($time=="2") echo ' selected="selected"'; ?>>White design</option>
                     <option value="3" <?php if($time=="3") echo ' selected="selected"'; ?>>Transparent design</option>
                    
			       

		          </select> </td>
</tr>
*/
?>
<tr valign="top">
<th scope="row"><label for="blogname">Text effect</label></th>
<td> <select name="op5<?php echo $id; ?>" id="op5<?php echo $id; ?>">
			        <option value="1" <?php if($op5=="1" || $op5=="") echo ' selected="selected"'; ?>>None</option>
                    
			        <option value="2" <?php if($op5=="2") echo ' selected="selected"'; ?>>Enter</option>
                     <option value="3" <?php if($op5=="3") echo ' selected="selected"'; ?>>Opacity</option>

                    
			       

		          </select> </td>
</tr>


</table>            

			     
</div>

 <div id="supersliderconfigc<?php echo $id; ?>" style="display:none;">
                  
                 
                  
                  <div id="icon-tools" class="icon32"><br /></div><h2>Effects</h2><br/>
                  
            
           
              <label>Effect columns(Number): </label> <input type='text' id='twidth<?php echo $id; ?>'  name='twidth<?php echo $id; ?>'  value='<?php echo $twidth; ?>' size="6"/>    
                  
                  <label>Effect rows(Number): </label> <input type='text' id='theight<?php echo $id; ?>'  name='theight<?php echo $id; ?>'  value='<?php echo $theight; ?>' size="6"/>          

 <label>Apply effects randomly: </label> 
             <select name="round<?php echo $id; ?>" id="round<?php echo $id; ?>">
                <option value="false" <?php if($round=='false') echo ' selected="selected"'; ?>>False</option>
                <option value="true" <?php if($round!='false') echo ' selected="selected"'; ?>>True</option>
              </select>
                    <br/>   <br/>   
                    
                    <?php
					
					$efectsa=array('swirlFadeOutRotate', 'swirlFadeOutRotateFancy', 'swirlFadeIn', 'swirlFadeOut', 'slabs', 'spiral', 'spiralReverse', 'diagonalShow', 'diagonalShowReverse', 'spiralDimension', 'spiralReverseDimension', 'boxFadeIn', 'boxFadeOutOriginal', 'boxFadeOutOriginalRotate', 'diagonalFade', 'diagonalFadeReverse', 'randomFade', 'randomDimensions', 'boxes', 'explode', 'explodeFancy', 'linearPeal', 'linearPealReverse', 'linearPealDimensions', 'linearPealReverseDimensions', 'blind', 'blindHorizontal', 'barsUp', 'barsDown', 'barsDownReverse', 'blindFade', 'fallingBlindFade', 'raisingBlindFade', 'mixBars', 'mixBarsFancy', 'fade', 'blindFadeReverse', 'slideIn',         'slideInFancy', 'slideInReverse', 'chop', 'chopDimensions', 'chopDiagonal', 'chopDiagonalReverse', 'slideLeft', 'slideRight', 'slideUp', 'slideDown');
					
					
					$auxarr=str_replace("--", "*", $sizethumbnail);
					$auxarr=str_replace("-", "", $auxarr);
					
					$arref=explode("*", $auxarr);
					$contae=0;
					
					echo '
<p>					<strong>Select the effects you want, next to each effect you can change a number that indicates the order of appearance.</strong></p>
					<table  cellspacing="2">';
					
					while($contae<count($arref)) {
						
						if($contae%3==0) echo '<tr>';
						
						if($arref[$contae]!="") {
						echo '<td style="background-color:#ddd; padding:10px;"><input type="checkbox" name="e'.$contae.'" id="e'.$contae.'" checked="checked" value="'.$arref[$contae].'"/> ';
						
						echo ' <input type="text" size="3" id="or'.$contae.'" name="or'.$contae.'" value="'.$contae.'" /> <label>'.$arref[$contae].'</label></td>';
						}
						$contae++;
						if($contae%3==0) echo '</tr>';
					}
					
					
					
					$contae2=0;
					
					while($contae2<count($efectsa)) {
						if(strpos($sizethumbnail, "-".$efectsa[$contae2]."-")===false) {
							if($contae%3==0) echo '<tr>';
						echo '<td style="background-color:#ddd; padding:10px;"><input type="checkbox" name="e'.$contae.'" id="e'.$contae.'" value="'.$efectsa[$contae2].'"/> 
						
						 <input type="text" size="3" id="or'.$contae.'" name="or'.$contae.'" value="'.$contae.'" /> <label>'.$efectsa[$contae2].'</label></td>';
						 $contae++;
						 if($contae%3==0) echo '</tr>';
						}
						$contae2++;
					}
					 if($contae%3!=0) echo '</tr>';
					echo '</table>';
					?>
                  
      




</div>

<input type='hidden' id='sizedescription<?php echo $id; ?>'  name='sizedescription<?php echo $id; ?>'  value='<?php echo $sizedescription; ?>'/>

           
        



       




        

<input name="id" type="hidden" id="id" value="<?php echo $id; ?>" />
<p class="submit"><input type="submit" name="submit" id="submit" class="button-primary" value="Save Changes"></p>
	
		 
      </fieldset>
	</form>		 
   

  </div>
</td>
</tr>