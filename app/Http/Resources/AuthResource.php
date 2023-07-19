<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'email' => $this->email,
            'username' => $this->username,
            'password' => Hash::make($request->newPassword),
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'created_at' => date_format($this->created_at,"Y/m/d H:i:s"),
        ];
    }
}
