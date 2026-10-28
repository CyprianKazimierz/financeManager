<?php

use App\Livewire\Actions\Logout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;
use App\Models\EmailOtp;

new #[Layout('components.layouts.auth')] class extends Component {
    /**
     * Send an email verification notification to the user.
     */

    public $user;
    public $code = '';

    // public function mount(Request $request)
    // {
    //     //$this->user = User::find($request->userId);
    // }

    /**
     * Log the current user out of the application.
     */

    public function verify()
    {
        // $otp = EmailOtp::where('user_id', $this->user->id)->latest()->first();

        // if (!$otp) {
        //     return back()->withErrors([
        //         'code' => 'No existe ningún código de verificación.',
        //     ]);
        // }

        // if ($otp->expires_at->isPast()) {
        //     return back()->withErrors([
        //         'code' => 'El código ha caducado.',
        //     ]);
        // }

        // if (!Hash::check($this->code, $otp->code)) {
        //     return back()->withErrors([
        //         'code' => 'El código es incorrecto.',
        //     ]);
        // }

        // $this->user->update([
        //     'email_verified_at' => now(),
        //     'verified' => true,
        // ]);

        // $otp->delete();

        // return redirect()->route('dashboard');
    }

    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
}; ?>

<div class="mt-4 flex flex-col gap-6">
    <div>

        <label>Código de verificación</label>

        <input wire:model="code" type="text" name="code" minlength="6" maxlength="6" required>

        <button wire:click="verify" type="submit">
            Verificar
        </button>
    </div>
</div>
