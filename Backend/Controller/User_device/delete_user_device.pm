package Controller::delete_user_device;

use strict;
use warnings;
use Mojo::UserAgent;

# Base URLs for your API
my $api_base_url = "http://127.0.0.1:3000/api";
my $user_devices_url = "$api_base_url/user_devices";

my $ua = Mojo::UserAgent->new;

# Handle the deletion of a user device
sub delete_user_device {
    my ($c) = @_;
    my $device_id = $c->param('device_id');
    my $user_id = $c->param('user_id');

    # Attempt to delete the device via API
    my $tx = $ua->delete("$user_devices_url/$device_id");

    if ($tx->result->is_success) {
        # Redirect back to the user's devices page after deletion
        $c->redirect_to("/user_devices/$user_id");
    } else {
        return $c->render(text => "Failed to delete device ID $device_id: " . $tx->result->message, status => 500);
    }
}

1;  # End of module
