<?php

function state($state, $badge=true) {
	if ($badge) {
		if ($state=='Inactivo') {
			return '<span class="badge badge-danger">'.$state.'</span>';
		} elseif ($state=='Activo') {
			return '<span class="badge badge-success">'.$state.'</span>';
		}
		return '<span class="badge badge-dark">'.$state.'</span>';
	}
	return $state;
}

function stateProduct($state, $badge=true) {
	if ($badge) {
		if ($state=='Inactivo') {
			return '<span class="badge badge-danger">'.$state.'</span>';
		} elseif ($state=='Agotado' || $state=='No Disponible') {
			return '<span class="badge badge-warning">'.$state.'</span>';
		} elseif ($state=='Activo') {
			return '<span class="badge badge-success">'.$state.'</span>';
		}
		return '<span class="badge badge-dark">'.$state.'</span>';
	}
	return $state;
}

function stateComplement($state, $badge=true) {
	if ($badge) {
		if ($state=='0') {
			return '<span class="badge badge-danger">No Visible</span>';
		} elseif ($state=='3') {
			return '<span class="badge badge-warning">Agotado</span>';
		} elseif ($state=='2') {
			return '<span class="badge badge-warning">No Disponible</span>';
		} elseif ($state=='1') {
			return '<span class="badge badge-success">Disponible</span>';
		}
		return '<span class="badge badge-dark">Desconocido</span>';
	} else {
		if ($state=='0') {
			return 'No Visible';
		} elseif ($state=='3') {
			return 'Agotado';
		} elseif ($state=='2') {
			return 'No Disponible';
		} elseif ($state=='1') {
			return 'Disponible';
		}
		return 'Desconocido';
	}
}

function stateOrder($state, $badge=true) {
	if ($badge) {
		if ($state=='Rechazado') {
			return '<span class="badge badge-danger">'.$state.'</span>';
		} elseif ($state=='En Espera') {
			return '<span class="badge badge-warning">'.$state.'</span>';
		} elseif ($state=='Confirmado') {
			return '<span class="badge badge-success">'.$state.'</span>';
		}
		return '<span class="badge badge-dark">'.$state.'</span>';
	}
	return $state;
}

function statePayment($state, $badge=true) {
	if ($badge) {
		if ($state=='Rechazado') {
			return '<span class="badge badge-danger">'.$state.'</span>';
		} elseif ($state=='Pendiente') {
			return '<span class="badge badge-warning">'.$state.'</span>';
		} elseif ($state=='Confirmado') {
			return '<span class="badge badge-success">'.$state.'</span>';
		}
		return '<span class="badge badge-dark">'.$state.'</span>';
	}
	return $state;
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
			return '<span class="badge badge-dark">Desconocido</span>';
		} else {
			return 'Desconocido';
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

function currencySymbol($currency) {
	if (!is_null($currency)) {
		return $currency->symbol;
	}
	return '';
}

function cartComplements($complements) {
	$num=0;
	$extras=[];
	foreach ($complements as $complement) {
		if (array_search($complement['group']['attribute']->name, array_column($extras, 'attribute'))!==false) {
			$i=array_search($complement['group']['attribute']->name, array_column($extras, 'attribute'));
			if (array_search($complement['complement']->name, array_column($extras[$i]['values'], 'name'))!==false) {
				$j=array_search($complement['complement']->name, array_column($extras[$i]['values'], 'name'));
				$extras[$i]['values'][$j]['qty']=$extras[$i]['values'][$j]['qty']+1;
			} else {
				$count=count($extras[$i]['values']);
				$extras[$i]['values'][$count]=array('qty' => 1, 'name' => $complement['complement']->name);
			}
		} else {
			$extras[$num]=array('attribute' => $complement['group']['attribute']->name, 'values' => array(array('qty' => 1, 'name' => $complement['complement']->name)));
			$num++;
		}
	}

	return $extras;
}

function typeDelivery($type, $badge=true) {
	if ($badge) {
		if ($type=='Comer en el Lugar' || $type=='Recoger para Llevar' || $type=='A Domicilio') {
			return '<span class="badge badge-primary">'.$type.'</span>';
		}
		return '<span class="badge badge-dark">'.$type.'</span>';
	}
	return $type;
}

function methodPayment($method, $badge=true) {
	if ($badge) {
		if ($method=='Tarjeta') {
			return '<span class="badge badge-primary">'.$method.'</span>';
		}
		return '<span class="badge badge-dark">'.$method.'</span>';
	}
	return $method;
}