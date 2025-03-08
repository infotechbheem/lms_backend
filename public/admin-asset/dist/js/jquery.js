$(document).ready(function () {
    // Listen for changes in the user_type dropdown
    $('#user_type').on('change', function () {
        var userType = $(this).val();

        // Clear all checkboxes when user_type is changed
        $('input[type="checkbox"]').prop('checked', false);

        // Make AJAX request only if userType is selected
        if (userType) {
            $.ajax({
                url: "/auth/admin/user/fetch-permissions/" + userType,
                type: "GET",
                dataType: "json",
                success: function (data) {
                    if (data) {
                        // Set the permissions dynamically based on the provided fields
                        $('#create_user_type').prop('checked', !!data.create_user_type);
                        $('#create_designation').prop('checked', !!data.create_designation);
                        $('#create_department').prop('checked', !!data.create_department);
                        $('#create_user').prop('checked', !!data.create_user);
                        $('#view_user').prop('checked', !!data.view_user);
                        $('#delete_user').prop('checked', !!data.delete_user);
                        $('#edit_user').prop('checked', !!data.edit_user);
                        $('#user_status_change').prop('checked', !!data.user_status_change);
                        $('#create_project').prop('checked', !!data.create_project);
                        $('#view_project').prop('checked', !!data.view_project);
                        $('#edit_project').prop('checked', !!data.edit_project);
                        $('#delete_project').prop('checked', !!data.delete_project);
                        $('#update_project_details').prop('checked', !!data.update_project_details);
                        $('#update_access_control_key').prop('checked', !!data.update_access_control_key);

                        $('#add_csr').prop('checked', !!data.add_csr);
                        $('#csr_status_change').prop('checked', !!data.csr_status_change);
                        $('#view_csr').prop('checked', !!data.view_csr);
                        $('#edit_csr').prop('checked', !!data.edit_csr);

                        $('#create_branch').prop('checked', !!data.create_branch);
                        $('#view_branch').prop('checked', !!data.view_branch);
                        $('#edit_branch').prop('checked', !!data.edit_branch);
                        $('#add_manager').prop('checked', !!data.add_manager);
                        $('#view_manager').prop('checked', !!data.view_manager);
                        $('#delete_manager').prop('checked', !!data.delete_manager);
                        $('#add_beneficiary').prop('checked', !!data.add_beneficiary);
                        $('#view_beneficiary').prop('checked', !!data.view_beneficiary);
                        $('#edit_beneficiary').prop('checked', !!data.edit_beneficiary);
                        $('#profiles_beneficiary').prop('checked', !!data.profiles_beneficiary);
                        $('#update_beneficiary_data').prop('checked', !!data.update_beneficiary_data);

                        $('#donation_activity').prop('checked', !!data.donation_activity);
                        $('#view_donation').prop('checked', !!data.view_donation);
                        $('#download_donation_receipt').prop('checked', !!data.download_donation_receipt);
                        $('#send_invoice').prop('checked', !!data.send_invoice);
                        $('#add_donation').prop('checked', !!data.add_donation);
                        $('#donation_controller').prop('checked', !!data.donation_controller);

                        $('#edit_company_profile').prop('checked', !!data.edit_company_profile);
                        $('#edit_payment_getway').prop('checked', !!data.edit_payment_getway);
                        $('#edit_mail_setting').prop('checked', !!data.edit_mail_setting);
                        $('#announcement_update').prop('checked', !!data.announcement_update);
                        $('#announcement_list_view').prop('checked', !!data.announcement_list_view);

                        $('#add_purpose').prop('checked', !!data.add_purpose);
                        $('#show_salary').prop('checked', !!data.show_salary);

                        $('#add_team_leader').prop('checked', !!data.add_team_leader);
                        $('#view_team_leader').prop('checked', !!data.view_team_leader);
                        $('#edit_team_leader').prop('checked', !!data.edit_team_leader);
                        $('#download_team_leader_id').prop('checked', !!data.download_team_leader_id);

                        $('#add_volunteer').prop('checked', !!data.add_volunteer);
                        $('#view_volunteer').prop('checked', !!data.view_volunteer);
                        $('#edit_volunteer').prop('checked', !!data.edit_volunteer);
                        $('#download_volunteer_id').prop('checked', !!data.download_volunteer_id);

                        $('#add_expanse').prop('checked', !!data.add_expanse);
                        $('#view_expanse').prop('checked', !!data.view_expanse);
                        $('#delete_expanse').prop('checked', !!data.delete_expanse);
                        $('#filter_expanse').prop('checked', !!data.filter_expanse);

                        $('#make_attendane').prop('checked', !!data.make_attendane);
                        $('#show_attendance').prop('checked', !!data.show_attendance);



                        $('#view_member_details').prop('checked', !!data.view_member_details);
                        $('#edit_member_details').prop('checked', !!data.edit_member_details);
                        $('#delete_member_details').prop('checked', !!data.delete_member_details);
                        $('#download_id_card').prop('checked', !!data.download_id_card);
                        $('#send_whatsapp').prop('checked', !!data.send_whatsapp);


                    }
                },
                error: function (xhr, status, error) {
                    console.log("Error fetching permissions:", error);
                }
            });
        }
    });


    $('#ngo_user_type').on('change', function () {
        var userType = $(this).val();
        var companyName = "{{ $companyName }}";  // Access the shared 'companyName' variable

        // Clear all checkboxes when user_type is changed
        $('input[type="checkbox"]').prop('checked', false);

        // Make AJAX request only if userType is selected
        if (userType) {
            $.ajax({
                url: "/auth/" + companyName + "/admin/user/fetch-permissions/" + userType,
                type: "GET",
                dataType: "json",
                success: function (data) {
                    if (data) {
                        // Set the permissions dynamically based on the provided fields
                        $('#create_user_type').prop('checked', !!data.create_user_type);
                        $('#create_designation').prop('checked', !!data.create_designation);
                        $('#create_department').prop('checked', !!data.create_department);
                        $('#create_user').prop('checked', !!data.create_user);
                        $('#view_user').prop('checked', !!data.view_user);
                        $('#delete_user').prop('checked', !!data.delete_user);
                        $('#edit_user').prop('checked', !!data.edit_user);
                        $('#user_status_change').prop('checked', !!data.user_status_change);
                        $('#create_project').prop('checked', !!data.create_project);
                        $('#view_project').prop('checked', !!data.view_project);
                        $('#edit_project').prop('checked', !!data.edit_project);
                        $('#delete_project').prop('checked', !!data.delete_project);
                        $('#update_project_details').prop('checked', !!data.update_project_details);
                        $('#update_access_control_key').prop('checked', !!data.update_access_control_key);
                        $('#add_csr').prop('checked', !!data.add_csr);
                        $('#csr_status_change').prop('checked', !!data.csr_status_change);
                        $('#view_csr').prop('checked', !!data.view_csr);
                        $('#edit_csr').prop('checked', !!data.edit_csr);
                        $('#create_branch').prop('checked', !!data.create_branch);
                        $('#view_branch').prop('checked', !!data.view_branch);
                        $('#edit_branch').prop('checked', !!data.edit_branch);
                        $('#add_manager').prop('checked', !!data.add_manager);
                        $('#view_manager').prop('checked', !!data.view_manager);
                        $('#delete_manager').prop('checked', !!data.delete_manager);
                        $('#add_beneficiary').prop('checked', !!data.add_beneficiary);
                        $('#view_beneficiary').prop('checked', !!data.view_beneficiary);
                        $('#edit_beneficiary').prop('checked', !!data.edit_beneficiary);
                        $('#profiles_beneficiary').prop('checked', !!data.profiles_beneficiary);
                        $('#update_beneficiary_data').prop('checked', !!data.update_beneficiary_data);

                        $('#donation_activity').prop('checked', !!data.donation_activity);
                        $('#view_donation').prop('checked', !!data.view_donation);
                        $('#download_donation_receipt').prop('checked', !!data.download_donation_receipt);
                        $('#send_invoice').prop('checked', !!data.send_invoice);
                        $('#add_donation').prop('checked', !!data.add_donation);
                        $('#donation_controller').prop('checked', !!data.donation_controller);

                        $('#add_volunteer').prop('checked', !!data.add_volunteer);
                        $('#view_volunteer').prop('checked', !!data.view_volunteer);
                        $('#edit_volunteer').prop('checked', !!data.edit_volunteer);
                        $('#download_volunteer_id').prop('checked', !!data.download_volunteer_id);

                        $('#add_purpose').prop('checked', !!data.add_purpose);
                        $('#show_salary').prop('checked', !!data.show_salary);

                        $('#add_team_leader').prop('checked', !!data.add_team_leader);
                        $('#view_team_leader').prop('checked', !!data.view_team_leader);
                        $('#edit_team_leader').prop('checked', !!data.edit_team_leader);
                        $('#download_team_leader_id').prop('checked', !!data.download_team_leader_id);

                        $('#add_expanse').prop('checked', !!data.add_expanse);
                        $('#view_expanse').prop('checked', !!data.view_expanse);
                        $('#delete_expanse').prop('checked', !!data.delete_expanse);
                        $('#filter_expanse').prop('checked', !!data.filter_expanse);

                        $('#make_attendane').prop('checked', !!data.make_attendane);
                        $('#show_attendance').prop('checked', !!data.show_attendance);

                        $('#view_member_details').prop('checked', !!data.view_member_details);
                        $('#edit_member_details').prop('checked', !!data.edit_member_details);
                        $('#delete_member_details').prop('checked', !!data.delete_member_details);
                        $('#download_id_card').prop('checked', !!data.download_id_card);
                        $('#send_whatsapp').prop('checked', !!data.send_whatsapp);
                    }
                },
                error: function (xhr, status, error) {
                    console.log("Error fetching permissions:", error);
                }
            });
        }
    });
});