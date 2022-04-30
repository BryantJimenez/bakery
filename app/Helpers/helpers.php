<?php

function state($state, $badge=true) {
	if ($badge) {
		if ($state==trans('admin.values_attributes.states.inactive')) {
			return '<span class="badge badge-danger">'.$state.'</span>';
		} elseif ($state==trans('admin.values_attributes.states.active')) {
			return '<span class="badge badge-success">'.$state.'</span>';
		}
		return '<span class="badge badge-dark">'.$state.'</span>';
	}
	return $state;
}

function stateProduct($state, $badge=true) {
	if ($badge) {
		if ($state==trans('admin.values_attributes.states.inactive')) {
			return '<span class="badge badge-danger">'.$state.'</span>';
		} elseif ($state==trans('admin.values_attributes.states.products.out of stock') || $state==trans('admin.values_attributes.states.products.not available')) {
			return '<span class="badge badge-warning">'.$state.'</span>';
		} elseif ($state==trans('admin.values_attributes.states.active')) {
			return '<span class="badge badge-success">'.$state.'</span>';
		}
		return '<span class="badge badge-dark">'.$state.'</span>';
	}
	return $state;
}

function stateComplement($state, $badge=true) {
	if ($badge) {
		if ($state=='0') {
			return '<span class="badge badge-danger">'.trans('admin.values_attributes.states.complements.not visible').'</span>';
		} elseif ($state=='3') {
			return '<span class="badge badge-warning">'.trans('admin.values_attributes.states.complements.out of stock').'</span>';
		} elseif ($state=='2') {
			return '<span class="badge badge-warning">'.trans('admin.values_attributes.states.complements.not available').'</span>';
		} elseif ($state=='1') {
			return '<span class="badge badge-success">'.trans('admin.values_attributes.states.complements.available').'</span>';
		}
		return '<span class="badge badge-dark">'.trans('admin.values_attributes.unknown').'</span>';
	} else {
		if ($state=='0') {
			return trans('admin.values_attributes.states.complements.not visible');
		} elseif ($state=='3') {
			return trans('admin.values_attributes.states.complements.out of stock');
		} elseif ($state=='2') {
			return trans('admin.values_attributes.states.complements.not available');
		} elseif ($state=='1') {
			return trans('admin.values_attributes.states.complements.available');
		}
		return trans('admin.values_attributes.unknown');
	}
}

function stateOrder($state, $badge=true) {
	if ($badge) {
		if ($state==trans('admin.values_attributes.states.orders.rejected')) {
			return '<span class="badge badge-danger">'.$state.'</span>';
		} elseif ($state==trans('admin.values_attributes.states.orders.waiting')) {
			return '<span class="badge badge-warning">'.$state.'</span>';
		} elseif ($state==trans('admin.values_attributes.states.orders.confirmed')) {
			return '<span class="badge badge-success">'.$state.'</span>';
		}
		return '<span class="badge badge-dark">'.$state.'</span>';
	}
	return $state;
}

function statePayment($state, $badge=true) {
	if ($badge) {
		if ($state==trans('admin.values_attributes.states.payments.rejected')) {
			return '<span class="badge badge-danger">'.$state.'</span>';
		} elseif ($state==trans('admin.values_attributes.states.payments.pending')) {
			return '<span class="badge badge-warning">'.$state.'</span>';
		} elseif ($state==trans('admin.values_attributes.states.payments.confirmed')) {
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
			$roles.=($user['roles']->count()==$num) ? trans('roles.'.$rol->name) : trans('roles.'.$rol->name)."<br>";
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
			return '<span class="badge badge-dark">'.trans('admin.values_attributes.unknown').'</span>';
		} else {
			return trans('admin.values_attributes.unknown');
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

function selectArrayDays($selectedItems) {
	$selects="";
	$arrays=['1' => trans('admin.values_attributes.days.1'), '2' => trans('admin.values_attributes.days.2'), '3' => trans('admin.values_attributes.days.3'), '4' => trans('admin.values_attributes.days.4'), '5' => trans('admin.values_attributes.days.5'), '6' => trans('admin.values_attributes.days.6'), '7' => trans('admin.values_attributes.days.7')];
	foreach ($arrays as $key => $array) {
		$select="";
		if (count($selectedItems)>0) {
			foreach ($selectedItems as $selected) {
				if ($selected==$key) {
					$select="selected";
					break;
				}
			}
		}
		$selects.='<option value="'.$key.'" '.$select.'>'.$array.'</option>';
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
		if ($type==trans('admin.values_attributes.types.deliveries.eat on site') || $type==trans('admin.values_attributes.types.deliveries.to take away') || $type==trans('admin.values_attributes.types.deliveries.delivery')) {
			return '<span class="badge badge-primary">'.$type.'</span>';
		}
		return '<span class="badge badge-dark">'.$type.'</span>';
	}
	return $type;
}

function methodPayment($method, $badge=true) {
	if ($badge) {
		if ($method==trans('admin.values_attributes.methods.card')) {
			return '<span class="badge badge-primary">'.$method.'</span>';
		}
		return '<span class="badge badge-dark">'.$method.'</span>';
	}
	return $method;
}

function scheduleText($days) {
	$collect=collect($days)->sort()->values();
	$stairway=($collect->count()>2) ? true : false;
	$i=$collect->first();
	
	foreach ($collect as $key => $value) {
		if ($collect->count()>2) {
			if ($value!=$i) {
				$stairway=false;
			}
		}
		$i++;
	}

	if ($stairway) {
		$text=trans('web.home.footer.schedule.text.stairway', ['first' => trans('admin.values_attributes.days.'.$collect->first()), 'last' => trans('admin.values_attributes.days.'.$collect->last())]);
	} else {
		if ($collect->count()>2) {
			$i=1;
			$text='';
			foreach ($collect as $key => $value) {
				$text.=trans('admin.values_attributes.days.'.$value);
				$text.=($collect->count()!=$i+1) ? ', ' : ' '.trans('web.home.footer.schedule.text.and').' ';
				$i++;
			}
			$text=substr($text, 0, -2);
		} elseif ($collect->count()==2) {
			$text=trans('web.home.footer.schedule.text.two days', ['first' => trans('admin.values_attributes.days.'.$collect->first()), 'last' => trans('admin.values_attributes.days.'.$collect->last())]);
		} elseif ($collect->count()==1) {
			$text=trans('admin.values_attributes.days.'.$collect->first());
		}
	}

	return $text;
}