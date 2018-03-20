<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Upload;

/**
 * 上传文件的控制器 暂不支持大文件
 * @author hyf
 *
 */
class UploadController extends Controller
{
    //
    private $request = null;
    
    public function  __construct(Request $request) 
    {
        $this->request = $request;
    }
    
    
    public function  index() 
    {
        //var_dump($_FILES);die();
        $re = $this->getFileInfo();
        $data = $re;
        $data['user_id'] = 1;
        $uploadId = Upload::create($data);
        if (!$uploadId) {
            return $this->error(null, '保存失败');
        } else {
            $re['fullurl'] = asset($re['url']);
            $re['id'] = $uploadId->id;
            return $this->success($re, '上传成功');
        }
        
    }
    
    
    /**
     * 
     * @return array
     */
    private function  getFileInfo()
    {
        $name = $this->request->input('name');
        $subdir = $this->request->input('subdir', 'files');
        $public = $this->request->input('ispublic', true);
        $uploadFile = $this->request->file('avatar');

        $re = [];
        $re['file_name'] = $uploadFile->getClientOriginalName();
        $re['size'] = $uploadFile->getClientSize();
        $re['type'] = $uploadFile->getClientMimeType();
        
        if ($public) {
            $re['path'] = $uploadFile->storePublicly(config('filesystems.disks.public.visibility'));
        } else {
            $re['path'] = $uploadFile->store($subdir);
        }

        $re['url'] =  Storage::url($re['path']);
        return $re;
    }
}
