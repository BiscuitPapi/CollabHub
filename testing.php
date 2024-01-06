$query = "SELECT u.name, cas.status, cas.application_ID, cas.applicant_IDFROM user uJOIN club_applicant_status cas ON u.user_ID = cas.applicant_ID
											WHERE cas.application_ID = '$club_ID';";