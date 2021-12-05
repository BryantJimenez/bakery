<?php

function state($state) {
	if ($state=='Inactive') {
		return '<span class="badge badge-danger">'.$state.'</span>';
	} elseif ($state=='Active') {
		return '<span class="badge badge-success">'.$state.'</span>';
	}
	return '<span class="badge badge-dark">'.$state.'</span>';
}

function stateProduct($state, $badge=true) {
	if ($badge) {
		if ($state=='Inactive') {
			return '<span class="badge badge-danger">'.$state.'</span>';
		} elseif ($state=='Out of Stock' || $state=='Not Available') {
			return '<span class="badge badge-warning">'.$state.'</span>';
		} elseif ($state=='Active') {
			return '<span class="badge badge-success">'.$state.'</span>';
		}
		return '<span class="badge badge-dark">'.$state.'</span>';
	}
	return $state;
}

function stateComplement($state, $badge=true) {
	if ($badge) {
		if ($state=='0') {
			return '<span class="badge badge-danger">Not Visible</span>';
		} elseif ($state=='3') {
			return '<span class="badge badge-warning">Out of Stock</span>';
		} elseif ($state=='2') {
			return '<span class="badge badge-warning">Not Available</span>';
		} elseif ($state=='1') {
			return '<span class="badge badge-success">Available</span>';
		}
		return '<span class="badge badge-dark">Unknown</span>';
	} else {
		if ($state=='0') {
			return 'Not Visible';
		} elseif ($state=='3') {
			return 'Out of Stock';
		} elseif ($state=='2') {
			return 'Not Available';
		} elseif ($state=='1') {
			return 'Available';
		}
		return 'Unknown';
	}
}

function roleUser($user, $badge=true) {
	$num=1;
	$roles="";
	foreach ($user['roles'] as $rol) {
		if ($user->hasRole($rol->name)) {
			$roles.=($user['roles']->count()==$num) ? $rol->name : $rol->name."<br>";
			$num++;
		}
	}

	if (!is_null($user['roles']) && !empty($roles)) {
		if ($badge) {
			return '<span class="badge badge-primary">'.$roles.'</span>';
		} else {
			return $roles;
		}
	} else {
		if ($badge) {
			return '<span class="badge badge-dark">Unknown</span>';
		} else {
			return 'Unknown';
		}
	}
}

function active($path, $group=null) {
	if (is_array($path)) {
		foreach ($path as $url) {
			if (is_null($group)) {
				if (request()->is($url)) {
					return 'active';
				}
			} else {
				if (is_int(strpos(request()->path(), $url))) {
					return 'active';
				}
			}
		}
		return '';
	} else {
		if (is_null($group)) {
			return request()->is($path) ? 'active' : '';
		} else {
			return is_int(strpos(request()->path(), $path)) ? 'active' : '';
		}
	}
}

function menu_expanded($path, $group=null) {
	if (is_array($path)) {
		foreach ($path as $url) {
			if (is_null($group)) {
				if (request()->is($url)) {
					return 'true';
				}
			} else {
				if (is_int(strpos(request()->path(), $url))) {
					return 'true';
				}
			}
		}
		return 'false';
	} else {
		if (is_null($group)) {
			return request()->is($path) ? 'true' : 'false';
		} else {
			return is_int(strpos(request()->path(), $path)) ? 'true' : 'false';
		}
	}
}

function submenu($path, $action=null) {
	if (is_array($path)) {
		foreach ($path as $url) {
			if (is_null($action)) {
				if (request()->is($url)) {
					return 'class=active';
				}
			} else {
				if (is_int(strpos(request()->path(), $url))) {
					return 'show';
				}
			}
		}
		return '';
	} else {
		if (is_null($action)) {
			return request()->is($path) ? 'class=active' : '';
		} else {
			return is_int(strpos(request()->path(), $path)) ? 'show' : '';
		}
	}
}

function selectArray($arrays, $selectedItems) {
	$selects="";
	foreach ($arrays as $array) {
		$select="";
		if (count($selectedItems)>0) {
			foreach ($selectedItems as $selected) {
				if (is_object($selected) && $selected->slug==$array->slug) {
					$select="selected";
					break;
				} elseif ($selected==$array->slug) {
					$select="selected";
					break;
				}
			}
		}
		$selects.='<option value="'.$array->slug.'" '.$select.'>'.$array->name.'</option>';
	}
	return $selects;
}

function store_files($file, $file_name, $route) {
	$image=$file_name.".".$file->getClientOriginalExtension();
	if (file_exists(public_path().$route.$image)) {
		unlink(public_path().$route.$image);
	}
	$file->move(public_path().$route, $image);
	return $image;
}

function image_exist($file_route, $image, $user_image=false, $large=true) {
	if (file_exists(public_path().$file_route.$image)) {
		$img=asset($file_route.$image);
	} else {
		if ($user_image) {
			$img=asset("/admins/img/template/usuario.png");
		} else {
			if ($large) {
				$img=asset("/admins/img/template/imagen.jpg");
			} else {
				$img=asset("/admins/img/template/image.jpg");
			}
		}
	}

	return $img;
}