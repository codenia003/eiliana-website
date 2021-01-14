
<!-- <div class="form-group col-sm-12">
    {!! Form::label('parent_id', 'Parent Id:') !!}
    {!! Form::text('parent_id', null, ['class' => 'form-control']) !!}
</div>
 -->
     <!-- Technology Name Field -->
<div class="form-group col-sm-12">
    {!! Form::label('technology_name', 'Technology Name:') !!}
    {!! Form::text('technology_name', null, ['class' => 'form-control']) !!}
</div>

<!-- Parent Id Field -->
	<div class="form-group col-sm-12">
		<label for="select1">Parent Name:</label>	
			<select name="parent_id" class="form-control" id="select1">
				 <option value="">----Select----</option>
				 <option value="0">No Select</option>	
				 @foreach ($technologies as $techno)			
				<option value="{{$techno->technology_id}}"  
				 @if(isset($technology->parent_id))
                         @if($technology->parent_id==$techno->technology_id)
                         selected
                          @endif 
                         @endif>{{$techno->technology_name}}</option>
				@endforeach
				<option value="0">No Select</option>
			</select>       
	</div>

<!-- Display Status Field -->
<div class="form-group col-sm-12">
    {!! Form::label('display_status', 'Display Status:') !!}
   <!--  {!! Form::text('display_status', null, ['class' => 'form-control']) !!} -->
    <select name="display_status" class="form-control" id="select2">
				<option value="1">Active</option>
				<option value="0">Inactive</option>
								
			</select>
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12 text-center">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('admin.technologies.index') !!}" class="btn btn-secondary">Cancel</a>
</div>
