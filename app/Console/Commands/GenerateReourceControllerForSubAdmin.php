<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

class GenerateReourceControllerForSubAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:res-controller-subadmin {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generates a resource controller with Api reource and requests for SubAdmin in AdminDashboard';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->argument('name');
        $controllerContents = '<?php

    namespace App\Http\Controllers\Api\V1\AdminDashboard\SubAdmin;

    use App\Http\Controllers\Controller;
    use App\Models\\' . $name . ';
    use App\Http\Requests\Api\V1\AdminDashboard\SubAdmin\\' . $name . 'Request\Store' . $name . 'Request;
    use App\Http\Requests\Api\V1\AdminDashboard\SubAdmin\\' . $name . 'Request\Update' . $name . 'Request;
    use App\Http\Resources\Api\V1\AdminDashboard\SubAdmin\\' . $name . 'Request\\' . $name . 'Resource;
    use Illuminate\Http\Request;
    /**
     * @group ' . $name . '
     *
     * This Api For ' . $name . ' for SubAdmin in AdminDashboard
     */
    class ' . $name . 'Controller extends Controller
    {
      /**
       * See all ' . $name . '
       * @response 200 scenario="Success Process"{
       * }
       *
       * @response 401 scenario="Account Not Admin"{
       "message": "Unauthenticated."
   }
       *
       * * @queryparam perPage int
       * To return limite data in single page.
       * Defaults value for variable \'15\'.
       *
       */
      public function index(Request $request)
      {
          $data = ' . $name . '::paginate($request->perPage ?? 15);

          return ' . $name . 'Resource::collection($data);
      }

      /**
       * See One ' . $name . '
       * @response 200 scenario="Success Process"{
       * }
       *
       * @response 401 scenario="Account Not Admin"{
       "message": "Unauthenticated."
   }
       *
       *
       * @response 404 scenario="This ' . $name . ' not found"{
       "message": "not found"
       }
       *
       */
      public function show(Request $request, ' . $name . ' $' . Str::camel($name) . ')
      {
          return new ' . $name . 'Resource($' . Str::camel($name) . ');
      }

      /**
       * Create ' . $name . '
       * @response 200 scenario="Success Process"{
       * }
       *
       *
       * @response 422 scenario="Validation errors"{

       *
       * @response 401 scenario="Account Not Admin"{
       "message": "Unauthenticated."
   }
       *
       */
      public function store(Store' . $name . 'Request $request)
      {
          $data = ' . $name . '::create($request->validated());
          return new ' . $name . 'Resource($data);
      }

      /**
       * Update ' . $name . '
       * @response 200 scenario="Success Process"{
       * }
       *
       * @response 422 scenario="Validation errors"{
       *
       * @response 404 scenario="This ' . $name . ' not found"{
       "message": "not found"
       }
       *
       * @response 401 scenario="Account Not Admin"{
       "message": "Unauthenticated."
   }
       *
       */
      public function update(Update' . $name . 'Request $request, ' . $name . ' $' . Str::camel($name) . ')
      {
          $' . Str::camel($name) . '->update($request->validated());
          $' . Str::camel($name) . '->refresh();
          return new ' . $name . 'Resource($' . Str::camel($name) . ');
      }
      /**
       * Delete ' . $name . '
       * @response 204 scenario="Success Process"
       *
       * @response 401 scenario="Account Not Admin"{
       "message": "Unauthenticated."
   }
       *
       *
       * @response 404 scenario="This ' . $name . ' not found"{
       "message": "not found"
       }
       *
       */
      public function destroy(' . $name . ' $' . Str::camel($name) . ')
      {
          $' . Str::camel($name) . '->delete();
          return response()->noContent();
      }
    }
    ';
        $this->file_force_contents('app/Http/Controllers/Api/V1/AdminDashboard/SubAdmin/' . $name . 'Controller.php', $controllerContents);
        $this->info('Controller has been created: app/Http/Controllers/Api/V1/AdminDashboard/SubAdmin/' . $name . 'Controller');
        $stroeRequestContents = '<?php
namespace App\Http\Requests\Api\V1\AdminDashboard\SubAdmin\\' . $name . 'Request\;

use Illuminate\Foundation\Http\FormRequest;

class Store' . $name . 'Request extends FormRequest
{
  /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
      return [
      ];
    }
    }
    ';
        $this->file_force_contents('app/Http/Requests/Api/V1/AdminDashboard/SubAdmin/' . $name . 'Request/Store' . $name . 'Request.php', $stroeRequestContents);
        $this->info('Store Request has been created: app/Http/Requests/Api/V1/AdminDashboard/SubAdmin/' . $name . 'Request/Store' . $name . 'Request.php');
        $updateRequestContents = '<?php

namespace App\Http\Requests\Api\V1\AdminDashboard\SubAdmin\\' . $name . 'Request\;

use Illuminate\Foundation\Http\FormRequest;

class Update' . $name . 'Request extends FormRequest
{
  /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
      return [
      ];
    }
    }
    ';
        $this->file_force_contents('app/Http/Requests/Api/V1/AdminDashboard/SubAdmin/' . $name . 'Request/Update' . $name . 'Request.php', $updateRequestContents);
        $this->info('Update Request has been created: app/Http/Requests/Api/V1/AdminDashboard/SubAdmin/' . $name . 'Request/Update' . $name . 'Request.php');
        $resourceContents = '<?php

namespace App\Http\Resources\Api\V1\AdminDashboard\SubAdmin\\' . $name . 'Request;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ' . $name . 'Resource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
        ];
    }
}
    ';
        $this->file_force_contents('app/Http/Resources/Api/V1/AdminDashboard/SubAdmin/' . $name . 'Resource/' . $name . 'Resource.php', $resourceContents);
        $this->info('Resource has been created: app/Http/Resources/Api/V1/AdminDashboard/SubAdmin/' . $name . 'Resource/' . $name . 'Resource.php');
    }
    private function file_force_contents($fullPath, $contents, $flags = 0)
    {
        $parts = explode('/', $fullPath);
        array_pop($parts);
        $dir = implode('/', $parts);

        if (!is_dir($dir))
            mkdir($dir, 0777, true);

        file_put_contents($fullPath, $contents, $flags);
    }
}
