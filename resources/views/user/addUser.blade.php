<x-app-layout>
    <div class="w-full">
        <p class="text-xl mb-4">Create New User</p>
        {{-- Show session error --}}
        @if (session('error'))
            <div class="bg-red-500 p-4 rounded-lg mb-6 text-white text-center">
                {{ session('error') }}
            </div>
        @endif
        {{-- Show session success --}}
        @if (session('success'))
            <div class="bg-green-500 p-4 rounded-lg mb-6 text-white text-center">
                {{ session('success') }}
            </div>
        @endif
        <div class="bg-white border border-slate-300 rounded-xl w-full p-3">
            <form action="{{ route('storeUser') }}" method="post">
                @csrf
                <table class="rounded-xl px-4 w-3/6">
                    <tbody >
                        <tr>
                            <td class="px-4 py-2"><label>Name</label></td>
                            <td class="px-4 py-2"><input type="text" name="name" class="form-control rounded-xl  bg-gray-200 border border-slate-400" required></td>
                        </tr>
                        <tr>
                            <td class="px-4 py-2"><label>Matric ID</label></td>
                            <td class="px-4 py-2"><input type="text" name="matric" class="form-control rounded-xl bg-gray-200 border border-slate-400" required></td>
                        </tr>
                        <tr>
                            <td class="px-4 py-2"><label>Email</label></td>
                            <td class="px-4 py-2"><input type="email" name="email" class="form-control rounded-xl bg-gray-200 border border-slate-400" required></td>
                        </tr>
                        <tr>
                            <td class="px-4 py-2"><label>Phone Number</label></td>
                            <td class="px-4 py-2"><input type="tel" name="phone" class="form-control rounded-xl bg-gray-200 border border-slate-400" required></td>
                        </tr>
                        <tr>
                            <td class="px-4 py-2"><label>Password</label></td>
                            <td class="px-4 py-2"><input type="password" name="password" class="form-control rounded-xl bg-gray-200 border border-slate-400" required></td>
                        </tr>
                        <tr>
                            <td class="px-4 py-2"><label>Confirm Password</label></td>
                            <td class="px-4 py-2"><input type="password" name="confirmpass" class="form-control rounded-xl bg-gray-200 border border-slate-400" required></td>
                        </tr>
                        {{-- Role --}}
                        <tr>
                            <td class="px-4 py-2"><label>Role</label></td>
                            <td class="px-4 py-2">
                                <select name="role" class="form-control rounded-xl bg-gray-200 border border-slate-400" required>
                                    <option value="admin">Admin</option>
                                    <option value="cashier">Cashier</option>
                                    <option value="coordinator">Coordinator</option>
                                </select>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="flex justify-end px-4 py-2">
                    <div class="px-4">
                        <input type="reset" value="Reset" class="btn border border-slate-400 bg-gray-400 px-3 py-2 rounded-xl hover:bg-gray-300">
                    </div>
                    <div class="px-4">
                        <input type="submit" value="Save" class="btn btn-success border border-slate-300 bg-emerald-500/80 px-3 py-2 rounded-xl hover:bg-emerald-400/80">
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
