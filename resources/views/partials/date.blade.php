

				<div class="form-group row">
					<label for="{{ $prop }}" class="col-sm-3 col-form-label"><div class="text-right">{{ $label }}</div></label>
					<div class="col-sm-9 input-group">
						<div class="input-group-prepend"> <span class="input-group-text fas fa-calendar-alt"></span></div>
						<input class="form-control date-field" type="text" name="{{ $prop }}" id="{{ $prop }}" value="{{ $model->$prop ?? '' }}" @isset($required) required @endisset>
					</div>

					@error($prop)
						<span class="alert alert-danger" role="alert">
							<strong>{{ $message }}</strong>
						</span>
					@enderror
				</div>