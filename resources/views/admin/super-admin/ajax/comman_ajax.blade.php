
    <script>

        $(document).ready(function () { 

                $('form#addSocialIconsForm1').validate({
                    rules: {
                        name: {
                            required: true,
                        },
                        address: {
                            required: true,
                            
                        },
                      
                        contact_id: {
                            required: true,
                        },
                        under_secretarient_name: {
                            required: true,
                        },
                       
                    },
                    messages: {
                        name: {
                            required: 'Name is required',
                        },
                      
                        colony: {
                            required: 'Colony is required.',
                        },
                        muncipaltiy: {
                            required: 'Muncipaltiy is required.',
                        },
                        contact_id: {
                            required: 'Contract  is required.',
                        },
                        under_secretarient_name: {
                            required: 'Under secretarient is required.',
                        },
                       
                    },
                    
                });

               
            });
    </script>
