<div id="form-modal" class="overlay modal overlay-open:opacity-100 hidden" role="dialog" tabindex="-1">
    <div class="modal-dialog overlay-open:opacity-100">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">User details</h3>
                <button type="button" class="btn btn-text btn-circle btn-sm absolute end-3 top-3" aria-label="Close"
                    data-overlay="#form-modal"><span class="icon-[tabler--x] size-4"></span></button>
            </div>
            <form>
                <div class="modal-body pt-0">
                    <div class="mb-4">
                        <label class="label label-text" for="fullName"> Full Name </label>
                        <input type="text" placeholder="John Doe" class="input" id="fullName" />
                    </div>
                    <div class="mb-0.5 flex gap-4 max-sm:flex-col">
                        <div class="w-full">
                            <label class="label label-text" for="email"> Email </label>
                            <input type="email" placeholder="johndoe@123@gmail.com" class="input" id="email" />
                        </div>
                        <div class="w-full">
                            <label class="label label-text" for="dateOfBirth"> DOB </label>
                            <input type="date" class="input" id="dateOfBirth" />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-soft btn-secondary" data-overlay="#form-modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
