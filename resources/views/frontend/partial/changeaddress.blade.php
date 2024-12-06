<div class="modal fade" id="change_add" tabindex="-1" aria-labelledby="change_addLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="change_addLabel">Address Change</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>



            <div class="modal-body">
                <div class="checkout__content--step section__shipping--address">

                    <div class="section__shipping--address__content">
                        <form action="{{ route('addresses.update', $address_data->id) }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-12 mb-12">
                                    <div class="checkout__input--list">
                                        <label>
                                            <input class="checkout__input--field border-radius-5" name="address"
                                                value="{{ $address_data->address }}" placeholder="Address" type="text"
                                                required>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-12 mb-12">
                                    <div class="checkout__input--list">
                                        <label>
                                            <input class="checkout__input--field border-radius-5" name="phone"
                                                value="{{ $address_data->phone }}" placeholder="Phone" required
                                                type="text">
                                        </label>
                                    </div>
                                </div>

                                <div class="col-12 mb-12">
                                    <div class="checkout__input--list checkout__input--select ">
                                        <label class="checkout__select--label" for="country">Country</label>
                                        <select required data-placeholder="Select a country"
                                            class=" js-states form-control select-2" name="country_id"
                                            id="edit_country">
                                            <option value="">Select your country</option>


                                            @php

                                            $countries = App\Models\Country::where('status',
                                            '1')->orderBy('name')->get();

                                            @endphp

                                            @foreach ($countries as $country)
                                            <option value="{{ $country->id }}" @if($address_data->country_id ==
                                                $country->id) selected @endif>
                                                {{ $country->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 mb-12">
                                    <div class="checkout__input--list checkout__input--select ">
                                        <label class="checkout__select--label" for="country">State</label>
                                        <select required data-placeholder="Select a state"
                                            class=" js-states form-control select-2" name="state_id" id="edit_state">
                                            @foreach ($states as $key => $state)
                                            <option value="{{ $state->id }}" @if($address_data->state_id == $state->id)
                                                selected @endif>
                                                {{ $state->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 mb-12">
                                    <div class="checkout__input--list checkout__input--select ">
                                        <label class="checkout__select--label" for="country">City</label>
                                        <select required data-placeholder="Select a city"
                                            class="select-2 js-states form-control" name="city_id">
                                            @foreach ($cities as $key => $city)
                                            
                                            <option value="{{ $city->id }}" @if($address_data->city_id == $city->id)
                                                selected @endif>
                                                {{ $city->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 mb-12">
                                    <div class="checkout__input--list">
                                        <label>
                                            <input class="checkout__input--field border-radius-5" name="postal_code"
                                                value="{{ $address_data->postal_code }}" required
                                                placeholder="Postal code" type="text">
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="checkout__checkbox">
                                <button type="submit" class="btn bg-red fs-4 text-white btn-lg">Save</button>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
     $(".js-states").select2({});
$(".select-2").select2({
    dropdownParent: $('#change_add'),
    
    placeholder: "Select a one",
});
</script>
