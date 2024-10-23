@extends('layouts.app')
@section('content')
<div class="container-fluid">{{--  Container  --}}
        <div class="row justify-content-center">  {{--  Center  --}}
           <div class="col-sm-6">  {{--  Datos  --}}
              <div class="card">  {{--  Card  --}}
                <div class="card-header separa_datos"><b>Modificar datos del periodo</b></div>
                 <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                     {!!Form::model($periodo,['url'=>['saveperiodo',$periodo->id_periodo], 'class'=>'form-horizontal' ,'method'=>'POST']) !!}
                     {!! csrf_field() !!} 
                     <div class="form-row">   {{--  div de form-row    --}}  
                     <div class="col-md-2">      
                      <div class="form-group{{ $errors->has('id_periodo') ? ' has-error' : '' }}">                          
                        {!!Form::label('id_periodo', 'ID Periodo'); !!}                        
                            {!! Form::text('id_periodo', null, ['id'=>'id_periodo','class'=>'form-control']) !!}
                            @if ($errors->has('id_periodo'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('id_periodo') }}</strong>
                                </span>
                            @endif
                      </div>
                    </div>
                    <div class="col-md-2">
                    <div class="form-group{{ $errors->has('id_periodo') ? ' has-error' : '' }}">                          
                        {!!Form::label('periodo', 'Periodo'); !!}
                       
                            {!! Form::text('periodo', null, ['id'=>'periodo','class'=>'form-control']) !!}
                            @if ($errors->has('periodo'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('periodo') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                        <div class="col-md-2">
                                <div class="form-group{{ $errors->has('año') ? ' has-error' : '' }}">
                                    {!!Form::label('año', 'Año'); !!}                      
                                        {!! Form::number('año', null, ['id'=>'año','class'=>'form-control']) !!}
                                        @if ($errors->has('año'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('año') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                        </div>
                    </div>   {{--  div row  --}}
                    <div class="form-row">   {{--  div de form-row    --}}  
                    <div class="col-md-2">
                    <div class="form-group{{ $errors->has('momento') ? ' has-error' : '' }}">
                        {!!Form::label('momento', 'Momento'); !!}                       
                            {!! Form::text('momento',null,['id'=>'momento','class'=>'form-control']) !!}
                            @if ($errors->has('momento'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('momento') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-2">
                    <div class="form-group{{ $errors->has('en_carga') ? ' has-error' : '' }}">                   
                        {!!Form::label('en_carga', 'En Carga'); !!}
                            {{Form::checkbox('en_carga', true)}}                          
                            
                            @if ($errors->has('en_carga'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('en_carga') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>   {{--  div row  --}}
                <div class="form-row">   {{--  div de form-row    --}}  
                    <div class="col-md-3">
                    <div class="form-group{{ $errors->has('fecha_cortedealtas') ? ' has-error' : '' }}">                    
                        {!!Form::label('fecha_cortedealtas', 'Fecha Corte de alta'); !!}                       
                            {!! Form::date('fecha_cortedealtas',null,['id'=>'fecha_cortedealtas','class'=>'form-control' ]) !!}
                            @if ($errors->has('fecha_cortedealtas'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('fecha_cortedealtas') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-3">
                    <div class="form-group{{ $errors->has('fecha_inicio') ? ' has-error' : '' }}">                       
                        {!!Form::label('fecha_inicio', 'Fecha de inicio'); !!}                       
                            {!! Form::date('fecha_inicio',null,['id'=>'fecha_inicio','class'=>'form-control']) !!}
                            @if ($errors->has('fecha_inicio'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('fecha_inicio') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div> 
                     <div class="col-md-3">  
                <div class="form-group{{ $errors->has('fecha_fin') ? ' has-error' : '' }}">
               
                        {!!Form::label('fecha_fin', 'Fecha de fin'); !!}                        
                            {!! Form::date('fecha_fin',null,['id'=>'fecha_fin','class'=>'form-control']) !!}
                            @if ($errors->has('fecha_fin'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('fecha_fin') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>   {{--  div row  --}}
         
                              <div class="form-group">
                               <div class="col-md-6 col-md-offset-4">
                                   <button type="submit" class="btn btn-primary">
                                       Modificar
                                   </button>                                     
                                 <a class="btn btn-primary" href="{{ route('periodo') }}">Volver</a>
                               </div>
                           </div>                 
                         {!!Form::close()!!}          
                    </li>                
                 </ul>
              </div>
           </div>
        </div>
    </div> 
@endsection
