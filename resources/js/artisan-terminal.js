import axios from 'axios';
import Swal from 'sweetalert2';

class ArtisanTerminal {
    constructor(options = {}) {
        this.container = options.container || '#artisan-terminal';
        this.commandSelect = options.commandSelect || '#artisan-command-select';
        this.paramsInput = options.paramsInput || '#artisan-params-input';
        this.outputContainer = options.outputContainer || '#artisan-output';
        this.executeButton = options.executeButton || '#artisan-execute-btn';

        this.init();
    }

    async init() {
        await this.loadCommands();
        this.bindEvents();
    }

    // Load available Artisan commands
    async loadCommands() {
        try {
            const response = await axios.get('/artisan/commands');
            const commands = response.data;

            // Populate command select
            const $select = $(this.commandSelect);
            $select.empty();

            commands.forEach(cmd => {
                $select.append(`
                    <option value="${cmd.command}">
                        ${cmd.command} - ${cmd.description}
                    </option>
                `);
            });

            // Initialize select2 or chosen plugin
            $select.select2({
                placeholder: 'Select Artisan Command',
                searchable: true
            });
        } catch (error) {
            this.showErrorToast('Failed to load commands');
        }
    }

    // Bind event listeners
    bindEvents() {
        $(this.executeButton).on('click', () => this.executeCommand());

        // Optional: Dynamic params input based on command
        $(this.commandSelect).on('change', (e) => {
            this.updateParamsInput(e.target.value);
        });
    }

    // Update params input dynamically
    updateParamsInput(command) {
        const paramPlaceholders = {
            'make:model': 'Enter model name (e.g., User)',
            'make:controller': 'Enter controller name (e.g., UserController)',
            // Add more command-specific placeholders
        };

        $(this.paramsInput).attr(
            'placeholder',
            paramPlaceholders[command] || 'Enter command parameters'
        );
    }

    // Execute Artisan command
    async executeCommand() {
        const command = $(this.commandSelect).val();
        const params = this.parseParams($(this.paramsInput).val());

        if (!command) {
            this.showErrorToast('Please select a command');
            return;
        }

        try {
            this.showLoading();

            const response = await axios.post('/artisan/execute', {
                command,
                params
            });

            this.displayOutput(command, response.data);
        } catch (error) {
            this.handleError(error);
        } finally {
            this.hideLoading();
        }
    }

    // Parse command parameters
    parseParams(paramString) {
        return paramString
            .split(' ')
            .filter(param => param.trim() !== '')
            .map(param => param.trim());
    }

    // Display command output
    displayOutput(command, data) {
        const $output = $(this.outputContainer);

        if (data.status === 'success') {
            $output.append(`
                <div class="command-result success">
                    <strong>Command: ${command}</strong>
                    <pre>${data.output || 'Command executed successfully'}</pre>
                </div>
            `);
        } else {
            $output.append(`
                <div class="command-result error">
                    <strong>Error: ${command}</strong>
                    <pre>${data.message}</pre>
                </div>
            `);
        }

        // Auto-scroll to bottom
        $output.scrollTop($output[0].scrollHeight);
    }

    // Error handling
    handleError(error) {
        Swal.fire({
            icon: 'error',
            title: 'Execution Failed',
            text: error.response?.data?.message || 'An unexpected error occurred'
        });
    }

    // Loading state
    showLoading() {
        $(this.executeButton)
            .prop('disabled', true)
            .html('<i class="fa fa-spinner fa-spin"></i> Executing');
    }

    hideLoading() {
        $(this.executeButton)
            .prop('disabled', false)
            .html('Execute Command');
    }

    // Show error toast
    showErrorToast(message) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: message,
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });
    }
}

export default ArtisanTerminal;

// // Usage
document.addEventListener('DOMContentLoaded', () => {
    new ArtisanTerminal({
        container: '#artisan-terminal',
        commandSelect: '#artisan-command-select',
        paramsInput: '#artisan-params-input',
        outputContainer: '#artisan-output',
        executeButton: '#artisan-execute-btn'
    });
});
