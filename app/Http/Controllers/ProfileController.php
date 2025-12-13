<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
class ProfileController extends StislaController
{

    /**
     * constructor method
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->middleware('can:Profil Ubah')->only(['update', 'updatePassword']);
    }

    /**
     * showing profil page
     *
     * @return Response
     */
    public function index()
    {
        $user = auth()->user();
        $totalDay = \Carbon\Carbon::parse($user->last_password_change)->diffInDays(now());

        return view('stisla.profile.index', [
            'user'     => $user,
            'd'        => $user,
            'totalDay' => $totalDay,
        ]);
    }

    /**
     * update profile user login
     *
     * @param ProfileRequest $request
     * @return Response
     */
    public function update(ProfileRequest $request)
    {
        $data = $request->only([
            'name',
            'name2',
            'email',
            'phone_number',
            'birth_date',
            'address',
            'address2',
            'nib',
            'lokasi_kantor_url',
            'cop_surat',
            'jabatan'
        ]);
        $user = auth()->user();
        if ($request->hasFile('avatar')) {
            $data['avatar'] = $this->fileService->uploadAvatar($request->file('avatar'));
        }
        // ✅ handle upload kop surat
        if ($request->hasFile('cop_surat')) {
            // simpan ke storage/app/public/kopsurat
            $path = $request->file('cop_surat')->store('kopsurat', 'public');
            $data['cop_surat'] = 'storage/' . $path;
    }
        
        $newUser = $this->userRepository->updateProfile($data);

        logUpdate('Profil Pengguna', $user, $newUser);
        return back()->with('successMessage', __('Berhasil memperbarui profil'));
    }

    /**
     * update password user login
     *
     * @param ProfileRequest $request
     * @return Response
     */
    public function updatePassword(ProfileRequest $request)
    {
        $oldPassword = auth()->user()->password;
        $data = [
            'password'             => $newPassword = bcrypt($request->new_password),
            'last_password_change' => date('Y-m-d H:i:s'),
        ];
        $this->userRepository->updateProfile($data);

        logUpdate('Kata Sandi', $oldPassword, $newPassword);
        return back()->with('successMessage', __('Berhasil memperbarui password'));
    }

    /**
     * update email user login
     *
     * @param ProfileRequest $request
     * @return Response
     */
    public function updateEmail(ProfileRequest $request)
    {
        $oldEmail = auth()->user()->email;
        $data = [
            'email' => $request->email
        ];
        $this->userRepository->updateProfile($data);

        logUpdate('Email', $oldEmail, $request->email);
        return back()->with('successMessage', __('Berhasil memperbarui email'));
    }
}
