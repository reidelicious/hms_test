<?php
/*
 * function that generate the action buttons edit, delete
 * This is just showing the idea you can use it in different view or whatever fits your needs
 */
function get_buttons($id)
{
    $ci = & get_instance();
    $html = '<center><span class="actions">';
    $html .= '<button class="primary editInfo"><i class="icon-pencil on-center"></i></button>';
	$html .= ' <button class="danger deleteUser"><i class="icon-cancel-2 on-center"></i></button>';
   // $html .= ' <a href="' . base_url() . 'subscriber/delete/' . $id . '"><button class="primary"><i class="icon-cancel-2 on-left"></i> Edit</button></a>';
    
    $html .= '<input type="hidden" value="'.$id.'" />';
	$html .= '</span></center>';
 
    return $html;
}

function get_buttons_wdetails($id, $det)
{
    $ci = & get_instance();
    $html = '<center><span class="actions">';
    $html .= '<button class="primary editInfo"><i class="icon-pencil on-center"></i></button>';
	$html .= ' <button class="danger deleteUser"><i class="icon-remove on-center"></i></button>';
   // $html .= ' <a href="' . base_url() . 'subscriber/delete/' . $id . '"><button class="primary"><i class="icon-cancel-2 on-left"></i> Edit</button></a>';
    
    $html .= '<input type="hidden" value="'.$id.'" />';
    $html .= '<div style="display:none;">'.$det.'</div>';
	$html .= '</span></center>';
 
    return $html;
}

function getbutton_rejected($mes)
{
    $ci = & get_instance();
    $html = '<center><span class="actions">';
    $html .= '<button class="default showMsg"><i class="icon-mail on-center"></i></button>';
   // $html .= ' <a href="' . base_url() . 'subscriber/delete/' . $id . '"><button class="primary"><i class="icon-cancel-2 on-left"></i> Edit</button></a>';
    $html .= '<div style="display:none;">'.$mes.'</div></center>';
    $html .= '</span>';
 
    return $html;
}

function getbutton_appointments($id){
    $ci = & get_instance();
    $html = '<center><span class="actions">';
    $html .= '<button class="success approve"><i class="icon-checkmark on-center"></i></button>';
    $html .= ' <button class="danger reject"><i class="icon-cancel-2 on-center"></i></button>';
   // $html .= ' <a href="' . base_url() . 'subscriber/delete/' . $id . '"><button class="primary"><i class="icon-cancel-2 on-left"></i> Edit</button></a>';
    
    $html .= '<input type="hidden" value="'.$id.'" />';
    $html .= '</span></center>';
 
    return $html;
} 
