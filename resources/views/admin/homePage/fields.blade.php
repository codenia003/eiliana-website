<!-- Title Field -->
<div class="form-group col-sm-12">
    {!! Form::label('title', 'Title:') !!}
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-12">
    {!! Form::label('description', 'Description:') !!}
    {!! Form::textarea('description', null, ['class'=>'form-control']) !!}
</div>	

<!-- Keywords Field -->
<div class="form-group col-sm-12">
    {!! Form::label('keywords', 'Keywords:') !!}
    {!! Form::textarea('keywords', null, ['class' => 'form-control']) !!}
</div>

<!-- 'Boolean active Field' -->
  <div class="form-group row ">
      {!! Form::label('active', 'Website On:',['class' => 'control-label text-right', 'style' => 'margin-left: 30px;']) !!}
      <div class="checkbox icheck">
          <label class="col-9 ml-2 form-check-inline">
              {!! Form::hidden('active', 0) !!}
              {!! Form::checkbox('active', 1, null) !!}
          </label>
      </div>
  </div> 		

<!-- Submit Field -->
<div class="form-group col-sm-12 text-center">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('admin.projectCategories.index') !!}" class="btn btn-secondary">Cancel</a>
</div>
