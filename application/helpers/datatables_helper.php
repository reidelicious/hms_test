<?php
/*
 * function that generate the action buttons edit, delete
 * This is just showing the idea you can use it in different view or whatever fits your needs
 */
function get_buttons($id)
{
    $ci = & get_instance();
    $html = '<span class="actions">';
    $html .= '<button class="default editInfo"><i class="icon-pencil on-left"></i> Edit</button>';
	$html .= ' <button class="primary deleteUser"><i class="icon-cancel-2 on-left"></i> Delete</button>';
   // $html .= ' <a href="' . base_url() . 'subscriber/delete/' . $id . '"><button class="primary"><i class="icon-cancel-2 on-left"></i> Edit</button></a>';
    $html .= '<input type="hidden" value="'.$id.'" />';
	$html .= '</span>';
 
    return $html;
}