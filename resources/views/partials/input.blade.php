				<div class="form-group row">
					<label for="{{ $prop }}" class="col-sm-3 col-form-label"><div class="text-right">{{ $label }}</div></label>
					<div class="col-sm-9">
						<input class="form-control" 
							type="{{ $input_type ?? 'text' }}" 
							name="{{ $prop }}" 
							id="{{ $prop }}" 
							value="{{ $default_val ?? $model->$prop ?? '' }}" 
							@isset($required) required @endisset 
							@isset($disabled) disabled @endisset 
							{!! $attributes ?? '' !!} 
							@isset($is_number) number='number' @endisset 
							@isset($placeholder) placeholder="{{ $placeholder }}" @endisset 
						>
					</div>

					@error($prop)
						<span class="offset-sm-3 col-sm-9 alert alert-danger" role="alert">
							<strong>{{ $message }}</strong>
						</span>
					@enderror
				</div>