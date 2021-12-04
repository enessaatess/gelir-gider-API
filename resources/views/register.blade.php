
                        <form action="{{ route('transaction.create') }}" method="POST">
                            @csrf
                            <div class="form-group mb-3">
                                <input type="text" placeholder="Total" id="total" class="form-control" name="total"
                                    required autofocus>
                                @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                            <div class="form-group mb-3">
                                <input type="date" placeholder="date" id="date" class="form-control" name="date"
                                    required>
                                @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                            <div class="form-group mb-3">
                                <input type="text" placeholder="description" id="description" class="form-control" name="description"
                                    >
                                @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                            <div class="form-group mb-3">
                                <select name="currency" id="currency">
                                    @foreach ($currency as $currencyList)
                                    <option value="{{ $currencyList->id }}">{{ $currencyList->name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('category_select'))
                                <span class="text-danger">{{ $errors->first('category_select') }}</span>
                                @endif
                            </div>
                            <div class="form-group mb-3">
                                <select name="category" id="category">
                                    @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('category_select'))
                                <span class="text-danger">{{ $errors->first('category_select') }}</span>
                                @endif
                            </div>

                          

                            <div class="d-grid mx-auto">
                                <button type="submit" class="btn btn-dark btn-block">Kaydet</button>
                            </div>
                        </form>