# VirtHook-VirtFusion-WebHook-Interceptor

Discord Bot README
This is a Discord bot script written in PHP that is currently under development. The bot aims to provide administrators with the ability to control virtual machines (VMs) by adding features such as stop, start, restart, and suspend.

Requirements
To use this Discord bot, you will need:

A web server running PHP
cURL extension enabled
Discord webhook URL (replace [WEBHOOK] in the code with the actual webhook URL)
Discord bot token (replace DiscordBot[Not Working!] in the code with the actual bot token)
Usage
Set up a web server with PHP support.
Obtain a Discord webhook URL by creating a webhook in your Discord server.
Replace [WEBHOOK] with the actual webhook URL in the code.
Obtain a Discord bot token by creating a bot in the Discord Developer Portal.
Replace DiscordBot[Not Working!] with the actual bot token in the code.
Deploy the PHP script to your web server.
Configure your Discord server to send notifications to the deployed PHP script.
Interact with the bot by sending commands to control the VMs.
Functionality
The Discord bot script performs the following tasks:

Retrieves incoming payload from Discord.
Processes the payload and extracts relevant information.
Determines the server status and assigns a corresponding color for embedding in Discord messages.
Formats the event name for display in the message.
Prepares additional server details (such as name, ID, RAM, IP, and CPU details).
Constructs a Discord message with the event and server details.
Sends the message to Discord using the provided webhook URL.
Adds reaction emojis (stop and start) to the sent message for user interaction.
Important Note
The current version of the script is not yet fully functional and is marked as "not working" for the Discord bot token. You need to replace the token with a valid Discord bot token to ensure proper functionality.

Credits
This Discord bot script was created by the developers at mylir.co.uk. Visit their website for more information.

For any inquiries or issues, please contact mylir.co.uk for support.

Note: Make sure to update the README with appropriate contact and support information if you are not affiliated with mylir.co.uk.
