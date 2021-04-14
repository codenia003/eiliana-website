<!-- Name Field -->
<div class="form-group col-sm-12">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Parent Id Field -->
<div class="form-group col-sm-12">
	<label for="select1">Parent Name:</label>	
		<select name="parent_id" class="form-control" id="select1">
			 <option value="">----Select----</option>
			 <option value="0">No Select</option>	
			 @foreach ($parentProjectCategories as $projectCate)			
			<option value="{{$projectCate->id}}"  
			 @if(isset($projectCate->parent_id))
			         @if($projectCategory == '0')
                     @elseif($projectCategory->parent_id==$projectCate->id)
                     selected
                      @endelseif
                      @endif 
                     @endif>{{$projectCate->name}}</option>
			@endforeach
		</select>       
</div>

<!-- Heading Field -->
<div class="form-group col-sm-12">
    {!! Form::label('heading', 'Heading:') !!}
    {!! Form::text('heading', null, ['class' => 'form-control']) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-12">
    {!! Form::label('descriptor', 'Description:') !!}
    {!! Form::textarea('descriptor', null, ['class'=>'form-control']) !!}
</div>	

<!-- Keywords Field -->
<div class="form-group col-sm-12">
    {!! Form::label('keywords', 'Keywords:') !!}
    {!! Form::text('keywords', null, ['class' => 'form-control']) !!}
</div>		

<!-- Submit Field -->
<div class="form-group col-sm-12 text-center">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('admin.projectCategories.index') !!}" class="btn btn-secondary">Cancel</a>
</div>
