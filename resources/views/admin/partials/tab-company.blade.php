<div class="tab-pane fade" id="company" role="tabpanel">
    <div class="mt-3">
        <div class="d-flex justify-content-start align-items-center mb-2 ms-3">
            <ion-icon name="briefcase-outline"></ion-icon>
            <h4 class="fw-bold ms-1 text-uppercase mt-1">Configurações da Empresa</h4>
        </div>

        <div class="border p-2 custom-card">
            <form action="{{ route('admin.update-company',$current_company->slug) }}" method="POST"
                  enctype="multipart/form-data">
                @csrf
                <div class="d-flex flex-column gap-2 w-100">
                    <label for="company_name"
                           class="form-label-custom d-flex justify-content-start align-items-center ps-2 rounded">
                        <span class="w-100">Nome da Empresa:</span>
                        <input type="text" id="company_name" name="company_name"
                               class="form-control-custom w-100" value="{{ $company->name ?? '' }}"
                               required>
                    </label>
                    @error('company_name')<span style="color: darkred">{{ $message }}</span>@enderror

                    <label for="company_logo"
                           class="form-label-custom d-flex justify-content-start align-items-center ps-2 rounded">
                        <span class="w-100">Logo da Empresa:</span>
                        <input type="text" id="logoNamePreview"
                               class="form-control-custom w-100" readonly>
                        <input type="file" name="logo" id="uploadLogo"
                               class="custom-file-input form-control-custom w-100" hidden>
                        <button class="btn btn-primary btn-sm me-1" type="button" id="btnLogoUpload">
                            UPLOAD
                        </button>
                    </label>
                    @error('company_logo')<span style="color: darkred">{{ $message }}</span>@enderror

                    <label for="favicon"
                           class="form-label-custom d-flex justify-content-start align-items-center ps-2 rounded">
                        <span class="w-100">Favicon:</span>
                        <input type="text" id="faviconNamePreview"
                               class="form-control-custom w-100" readonly>
                        <input type="file" name="favicon" id="uploadFavicon"
                               class="custom-file-input form-control-custom w-100" hidden>
                        <button class="btn btn-primary btn-sm me-1" type="button" id="btnFaviconUpload">
                            UPLOAD
                        </button>
                    </label>
                    @error('favicon')<span style="color: darkred">{{ $message }}</span>@enderror
                    <label for="primary_color"
                           class="form-label-custom d-flex justify-content-start align-items-center ps-2 rounded">
                        <span class="w-100">Cor Primária:</span>
                        <input type="color" name="primary_color" id="primary_color"
                               value="{{ $company->primary_color ?? '' }}"
                               class="form-control-custom">
                    </label>
                    @error('primary_color')<span style="color: darkred">{{ $message }}</span>@enderror
                    <label for="secondary_color"
                           class="form-label-custom d-flex justify-content-start align-items-center ps-2 rounded">
                        <span class="w-100">Cor Secundária:</span>
                        <input type="color" name="secondary_color" id="secondary_color"
                               value="{{ $company->secondary_color ?? '' }}"
                               class="form-control-custom">
                    </label>
                    @error('secondary_color')<span style="color: darkred">{{ $message }}</span>@enderror
                    <label for="tertiary_color"
                           class="form-label-custom d-flex justify-content-start align-items-center ps-2 rounded">
                        <span class="w-100">Cor Terciária:</span>
                        <input type="color" name="tertiary_color" id="tertiary_color"
                               value="{{ $company->tertiary_color ?? '' }}"
                               class="form-control-custom">
                    </label>
                    @error('tertiary_color')<span style="color: darkred">{{ $message }}</span>@enderror
                    <label for="buttons_color"
                           class="form-label-custom d-flex justify-content-start align-items-center ps-2 rounded">
                        <span class="w-100">Cor dos botões:</span>
                        <input type="color" name="buttons_color" id="buttons_color"
                               value="{{ $company->buttons_color ?? '' }}"
                               class="form-control-custom">
                    </label>
                    @error('buttons_color')<span style="color: darkred">{{ $message }}</span>@enderror
                    <label for="notices_color"
                           class="form-label-custom d-flex justify-content-start align-items-center ps-2 rounded">
                        <span class="w-100">Avisa a cor:</span>
                        <input type="color" name="notices_color" id="notices_color"
                               value="{{ $company->notices_color ?? '' }}"
                               class="form-control-custom">
                    </label>
                    @error('notices_color')<span style="color: darkred">{{ $message }}</span>@enderror
                    <label for="plan_checkout_link"
                           class="form-label-custom d-flex justify-content-start align-items-center ps-2 rounded">
                        <span class="w-100">Plano de link de checkout:</span>
                        <input type="text" id="plan_checkout_link" name="plan_checkout_link"
                               class="form-control-custom w-100" value="{{ $company->plan_checkout_link ?? '' }}"
                               required>
                    </label>
                    @error('plan_checkout_link')<span style="color: darkred">{{ $message }}</span>@enderror
                </div>
                <div class="text-end mt-3">
                    <button type="submit" class="btn btn-primary btn-sm">SALVAR</button>
                </div>
            </form>
        </div>
    </div>

</div>
