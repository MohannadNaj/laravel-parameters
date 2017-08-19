<?php

namespace Parameter\Http\Controllers;

use Parameter\Parameter;
use Parameter\ParametersManager;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use \Parameter\ParametersValidator;
use Storage ;

class ParameterController extends Controller
{
    public function __construct()
    {
        
    }

    public function index()
    {
        $data['parameters'] = param();

        return view('parameters::index', $data);
    }

    public function store(Request $request)
    {
        $this->validate($request, ParametersValidator::newRules($request->type));

        $parameter = Parameter::create($request->only('name','type','label','category_id'));

        return ['parameter'=>$parameter];
    }

    public function update(Request $request, Parameter $parameter)
    {
        $this->validate($request, ParametersValidator::updateRules($parameter->type));

        $parameter->update($request->all());

        return $parameter;
    }

    public function destroy(Parameter $parameter)
    {
        $parameterCopy = clone $parameter;

        $parameter->delete();

        return ['data'=>$parameterCopy];
    }

    public function addPhoto(Request $request)
    {
        if(! $request->file('file')->isValid())
            return ['Error in uploading file'];

        $this->validate($request,
            [ 'file' => ParametersValidator::updateRules('file')['value'] ]);
        
        $path = $request->file->store('uploads','local');

        return ['path'=>$path];
    }

    public function updatePhoto(Request $request)
    {
        $this->validate($request, ['path'=>'required', 'parameter'=>'required|integer']);
        $path = $request->path;

        if (! Storage::disk('local')->exists($path)) {
            return ['Error in uploading file'];
        }

        $local = Storage::disk('local')->get($path);

        $public = Storage::disk('public')->put($path, $local);

        $data = ['path'=> $path, 'url'=> Storage::disk('public')->url($path) ];

        $parameter = param()->where('id', $request->parameter)->first();

        $parameter->update(['value'=>$path]);

        $data['parameter'] = $parameter;

        return $data;
    }

    public function choseCategory(Request $request, Parameter $parameter, $category_id = null)
    {
        $parameter->category_id = $category_id;
        $parameter->save();

        return ['parameter'=>$parameter];
    }
    public function addCategory(Request $request)
    {
        $data['type'] = 'textfield';
        $data['name'] = 'category-' . Str::random();
        $data['is_category'] = true;
        $data['label'] = $request->value;

        $request->merge($data);

        $this->validate($request, ParametersValidator::newRules($request->type));

        $parameter = Parameter::create($request->only('is_category', 'value', 'name','type','label'))->fresh();

        return ['parameter'=>$parameter];
    }
}
