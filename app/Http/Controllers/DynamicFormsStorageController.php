<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Northwestern\SysDev\DynamicForms\Storage\Concerns\HandlesDynamicFormsStorage;
use App\Models\Form;
use App\Models\FormField;


/**
 * Storage/retrieval for file uploads.
 */
class DynamicFormsStorageController extends Controller
{
    use HandlesDynamicFormsStorage;

    /**
     * Performs an authorization check for upload/download requests.
     *
     * This method should throw an AuthorizationException if the user is not authorized to
     * perform the requested $action on $fileKey.
     *
     * The easiest way to do that is to write an authorization gate, and then run Gate::authorize('fileUpload').
     * This method will throw an AuthorizationException if the user fails the check.
     *
     * However, you are free to implement this method in whatever way makes sense to you. You do not need to use
     * the Gate facade.
     *
     * @param string $action upload or download
     * @param string $fileKey The file key (S3 object key or file name)
     * @param Request $request The full Request object
     *
     * @throws AuthorizationException
     */
    protected function authorizeFileAction(string $action, string $fileKey, Request $request, string $backend): void
    {
        /*
        $permission = "${action}Files"; // uploadFiles, downloadFiles -- it's a convention

        Gate::authorize($permission, [
            $request->user(),
            $fileKey
        ]);
        */

        throw new AuthorizationException('Please implement the authorize method in ' . __CLASS__, '403');
    }

    public function show(Request $request, $id)
    {
        $form = Form::where('id', $id)->with('formFields')->first();
        return view('admin.forms.formdetail', compact('form'));
    }

    public function update(Request $request, $id)
    {
        $form = Form::find($id);
        $update = $form->update([
            'name'       => $request->name ?? $form->name,
            'visibility' => $request->visibility ?? $form->visibility,
            'status'     => $request->status ?? $form->status
        ]);
        if($update)
        {
            return redirect()->route('admin.forms')->with('success', 'form updated successfully');
        }
        
    }

    public function delete(Request $request, $id)
    {
        $form = Form::find($id);
        $form->delete();
        return redirect()->back()->with('success', 'form deleted successfully');
    }

}
