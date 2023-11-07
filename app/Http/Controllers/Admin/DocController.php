<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Models\Doc;
use App\Utils\FrontendUility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

/**
 * Контроллер - управление документами
 *
 */
class DocController extends BaseController
{
    /**
     * Редактировать
     */
    public function edit(Doc $doc)
    {
        return view('admin.doc.edit', compact('doc', 'doc'));
    }

    /**
     * Обновить
     */
    public function update(Request $request, Doc $doc)
    {
        $doc->bodytext = $request->input('bodytext');
        $doc->category = $request->input('category');
        $doc->save();
        $request->session()->flash('flash_messages_success', 'Запись [' . $doc->id . '] успешно обновлена');
        return redirect()->back();
    }

    /**
     * Удалить
     */
    public function delete(Doc $doc)
    {
        return view('admin.doc.delete', compact('doc'));
    }

    /**
     * Удалить (процесс)
     */
    public function destroy(Request $request, Doc $doc)
    {
        if ($doc->delete()) {

            $request->session()->flash('flash_messages_success', 'Документ [' . $doc->id . '] успешно удален');
            return redirect()->route('site.doc');
        }
        $request->session()->flash('flash_messages_error', 'Ошибка удаления документа [' . $doc->id . ']');
        return redirect()->route('site.doc');
    }
}
