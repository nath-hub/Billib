<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Contracts\Validation\Factory as ValidationFactory;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' =>'required_without:identifiant|string|email|exists:users,email',
             'identifiant' => 'required_without:email|string|exists:users,identifiant',
        ];
    }
    
    
          public function getCredentials()
            {
                $username = $this->get('username');
        
                if ($this->isEmail($username)) {
                    return [
                        'email' => $username
                    ];
                }
        
                return $this->only('username', 'password');
            }  
            
            
        private function isEmail($param)
                {
                    $factory = $this->container->make(ValidationFactory::class);
            
                    return ! $factory->make(
                        ['username' => $param],
                        ['username' => 'email']
                    )->fails();
                }
                
      protected function authenticated(Request $request, $user) 
            {
                return redirect()->intended();
            }
  
}
