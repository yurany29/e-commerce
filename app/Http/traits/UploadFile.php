<?php

namespace App\Http\Traits;

use App\Models\Product;
use App\Models\File;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File as FileSystem;

trait UploadFile
{
	private function uploadFile($model, $request)
	{
		if (!isset($request->file)) return;
		$random = Str::random(20);
		$path = $this->getRoute($model);
		$this->deleteFile($model);
		$imageName = "{$random}.{$request->file->clientExtension()}";
		$request->file->move(storage_path("app/public/{$path}"), $imageName);
		$file = new File(['route' => "/storage/{$path}/{$imageName}"]);
		$model->file()->save($file);
	}

	private function deleteFile($model)
	{
		$file = File::where('fileable_id', $model->id)
			->where('fileable_type', get_class($model))
			->first();
		if (!$file) return;
		$fileIsNotDefault = $file->route != "/storage/{$this->getRoute($model)}/default.png";
		$issetFile = FileSystem::exists(public_path($file->route));
		if ($issetFile && $fileIsNotDefault) {
			FileSystem::delete(public_path($file->route));
		}
		$file->delete();
	}

	private function getRoute($model)
	{
		$routes = [
			Product::class => 'images/products',
		];
		return $routes[get_class($model)] ?? 'images';
	}
}