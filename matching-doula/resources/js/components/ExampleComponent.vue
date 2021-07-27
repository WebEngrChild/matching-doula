<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Example Component1</div>
                    <div class="card-body">
                        I'm an example component1.
                        <b-button>Button</b-button>
                        <b-button variant="danger">Button</b-button>
                        <b-button variant="success">Button</b-button>
                        <b-button variant="outline-primary">Button</b-button>
                    </div>
                    <div class="card-header">Example Component2</div>
                    <div class="card-body">
                        I'm an example component2.
                        <b-dropdown id="dropdown-dropright" dropright text="Drop-Right" variant="primary" class="m-2">
                            <b-dropdown-item href="#">Action</b-dropdown-item>
                            <b-dropdown-item href="#">Another action</b-dropdown-item>
                            <b-dropdown-item href="#">Something else here</b-dropdown-item>
                        </b-dropdown>

                        <b-dropdown id="dropdown-dropleft" dropleft text="Drop-Left" variant="primary" class="m-2">
                            <b-dropdown-item href="#">Action</b-dropdown-item>
                            <b-dropdown-item href="#">Another action</b-dropdown-item>
                            <b-dropdown-item href="#">Something else here</b-dropdown-item>
                        </b-dropdown>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
