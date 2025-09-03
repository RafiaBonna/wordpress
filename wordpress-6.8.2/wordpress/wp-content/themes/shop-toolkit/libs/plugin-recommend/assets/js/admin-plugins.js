/**
 * Shop Toolkit Pro Plugin Recommendations Admin JavaScript
 */

(function($) {
    'use strict';

    $(document).ready(function() {
        // Initialize plugin recommendations
        PluginRecommendations.init();
    });

    var PluginRecommendations = {
        
        init: function() {
            this.bindEvents();
            this.initFilters();
            
            // Check if recommended plugins notice should be hidden
            if (window.location.href.indexOf('wp-admin') !== -1) {
                this.checkRecommendedPluginsStatus();
            }
        },

        bindEvents: function() {
            // Install plugin
            $(document).on('click', '.install-plugin', this.installPlugin);
            
            // Activate plugin
            $(document).on('click', '.activate-plugin', this.activatePlugin);
            
            // Update plugin
            $(document).on('click', '.update-plugin', this.updatePlugin);
            
            // Filter tabs
            $(document).on('click', '.filter-tab', this.filterPlugins);
            
            // Dismiss plugin notice
            $(document).on('click', '.blog-build-pro-plugin-notice .notice-dismiss', this.dismissNotice);
            
            // Dismiss recommended notice
            $(document).on('click', '.blog-build-pro-recommended-notice .notice-dismiss', this.dismissNotice);
            
            // Dismiss update notice
            $(document).on('click', '.blog-build-pro-update-notice .notice-dismiss', this.dismissUpdateNotice);
            
            // Bulk install required plugins
            $(document).on('click', '#install-required-plugins', this.bulkInstallRequired);
            
            // Bulk install recommended plugins
            $(document).on('click', '#install-recommended-plugins', this.bulkInstallRecommended);
            
            // Update all plugins
            $(document).on('click', '#update-all-plugins', this.updateAllPlugins);
        },

        initFilters: function() {
            // Set initial counts
            this.updateFilterCounts();
        },

        installPlugin: function(e) {
            e.preventDefault();
            
            var $button = $(this);
            var slug = $button.data('slug');
            var isLocal = $button.data('is-local') === 1;
            var originalText = $button.text();
            
            // Disable button and show loading
            $button.addClass('loading').prop('disabled', true);
            
            $.ajax({
                url: blogBuildProPlugins.ajaxurl,
                type: 'POST',
                data: {
                    action: 'blog_build_install_plugin',
                    slug: slug,
                    is_local: isLocal ? '1' : '0',
                    nonce: blogBuildProPlugins.nonce
                },
                success: function(response) {
                    if (response.success) {
                        PluginRecommendations.showMessage($button, response.data.message || blogBuildProPlugins.strings.installed, 'success');
                        
                        // Update plugin status
                        setTimeout(function() {
                            PluginRecommendations.updatePluginStatus(slug, 'inactive');
                            
                            // Auto-activate the plugin
                            $button.removeClass('loading').trigger('click');
                        }, 1000);
                    } else {
                        PluginRecommendations.showMessage($button, response.data.message || blogBuildProPlugins.strings.error, 'error');
                        $button.removeClass('loading').prop('disabled', false);
                    }
                },
                error: function() {
                    PluginRecommendations.showMessage($button, blogBuildProPlugins.strings.error, 'error');
                    $button.removeClass('loading').prop('disabled', false);
                }
            });
        },

        activatePlugin: function(e) {
            e.preventDefault();
            
            var $button = $(this);
            var file = $button.data('file');
            var slug = $button.data('slug');
            var originalText = $button.text();
            
            // Disable button and show loading
            $button.addClass('loading').prop('disabled', true);
            
            $.ajax({
                url: blogBuildProPlugins.ajaxurl,
                type: 'POST',
                data: {
                    action: 'blog_build_activate_plugin',
                    file: file,
                    nonce: blogBuildProPlugins.nonce
                },
                success: function(response) {
                    if (response.success) {
                        PluginRecommendations.showMessage($button, blogBuildProPlugins.strings.activated, 'success');
                        
                        // Update plugin status
                        setTimeout(function() {
                            PluginRecommendations.updatePluginStatus(slug, 'active');
                            
                            // Check if all recommended plugins are now active
                            PluginRecommendations.checkRecommendedPluginsStatus();
                        }, 1000);
                    } else {
                        PluginRecommendations.showMessage($button, response.data || blogBuildProPlugins.strings.error, 'error');
                        $button.removeClass('loading').prop('disabled', false);
                    }
                },
                error: function() {
                    PluginRecommendations.showMessage($button, blogBuildProPlugins.strings.error, 'error');
                    $button.removeClass('loading').prop('disabled', false);
                }
            });
        },

        updatePlugin: function(e) {
            e.preventDefault();
            
            var $button = $(this);
            var slug = $button.data('slug');
            var file = $button.data('file');
            var isLocal = $button.data('is-local') === 1;
            var originalText = $button.text();
            
            // Disable button and show loading
            $button.addClass('loading').prop('disabled', true);
            
            $.ajax({
                url: blogBuildProPlugins.ajaxurl,
                type: 'POST',
                data: {
                    action: 'blog_build_update_plugin',
                    slug: slug,
                    file: file,
                    is_local: isLocal ? '1' : '0',
                    nonce: blogBuildProPlugins.nonce
                },
                success: function(response) {
                    if (response.success) {
                        PluginRecommendations.showMessage($button, response.data.message || blogBuildProPlugins.strings.updated, 'success');
                        
                        // Update plugin status to active (since it was reactivated)
                        setTimeout(function() {
                            PluginRecommendations.updatePluginStatus(slug, 'active');
                            
                            // Check if all recommended plugins are now active
                            PluginRecommendations.checkRecommendedPluginsStatus();
                        }, 1000);
                    } else {
                        PluginRecommendations.showMessage($button, response.data.message || blogBuildProPlugins.strings.error, 'error');
                        $button.removeClass('loading').prop('disabled', false);
                    }
                },
                error: function() {
                    PluginRecommendations.showMessage($button, blogBuildProPlugins.strings.error, 'error');
                    $button.removeClass('loading').prop('disabled', false);
                }
            });
        },

        filterPlugins: function(e) {
            e.preventDefault();
            
            var $tab = $(this);
            var filter = $tab.data('filter');
            
            // Update active tab
            $('.filter-tab').removeClass('active');
            $tab.addClass('active');
            
            // Filter plugin cards
            $('.plugin-card').each(function() {
                var $card = $(this);
                var status = $card.data('status');
                var featured = $card.data('featured');
                var required = $card.data('required');
                var show = false;
                
                switch (filter) {
                    case 'all':
                        show = true;
                        break;
                    case 'featured':
                        show = featured == 1;
                        break;
                    case 'required':
                        show = required == 1;
                        break;
                    case 'active':
                        show = status === 'active';
                        break;
                    case 'inactive':
                        show = status === 'inactive';
                        break;
                    case 'not-installed':
                        show = status === 'not-installed';
                        break;
                }
                
                if (show) {
                    $card.removeClass('hidden').fadeIn(300);
                } else {
                    $card.addClass('hidden').fadeOut(300);
                }
            });
            
            // Update URL without reloading
            if (history.pushState) {
                var newUrl = window.location.href.split('?')[0] + '?page=blog-build-plugins';
                if (filter !== 'all') {
                    newUrl += '&filter=' + filter;
                }
                history.pushState(null, null, newUrl);
            }
        },

        updateFilterCounts: function() {
            var counts = {
                all: 0,
                featured: 0,
                required: 0,
                active: 0,
                inactive: 0,
                'not-installed': 0
            };
            
            $('.plugin-card').each(function() {
                var $card = $(this);
                var status = $card.data('status');
                var featured = $card.data('featured');
                var required = $card.data('required');
                
                counts.all++;
                counts[status]++;
                
                if (featured == 1) {
                    counts.featured++;
                }
                
                if (required == 1) {
                    counts.required++;
                }
            });
            
            // Update tab text with counts
            $('.filter-tab').each(function() {
                var $tab = $(this);
                var filter = $tab.data('filter');
                var count = counts[filter];
                var baseText = $tab.text().split(' (')[0];
                
                if (count > 0) {
                    $tab.text(baseText + ' (' + count + ')');
                } else {
                    $tab.text(baseText);
                }
            });
        },

        showMessage: function($button, message, type) {
            var $card = $button.closest('.plugin-card');
            var $message = $('<div class="plugin-message"></div>')
                .text(message)
                .addClass(type === 'error' ? 'error' : '')
                .appendTo($card);
            
            // Show message
            setTimeout(function() {
                $message.addClass('show');
            }, 100);
            
            // Hide message after 3 seconds
            setTimeout(function() {
                $message.removeClass('show');
                setTimeout(function() {
                    $message.remove();
                }, 300);
            }, 3000);
        },

        dismissNotice: function(e) {
            var $notice = $(this).closest('.notice');
            var noticeType = 'recommended'; // default
            
            // Determine notice type based on CSS class
            if ($notice.hasClass('blog-build-pro-recommended-notice')) {
                noticeType = 'recommended';
            }
            
            // Send AJAX request to hide notice permanently
            $.post(blogBuildProPlugins.ajaxurl, {
                action: 'blog_build_dismiss_plugin_notice',
                notice_type: noticeType,
                nonce: blogBuildProPlugins.nonce
            });
        },

        dismissUpdateNotice: function() {
            // Send AJAX request to hide update notice for 7 days
            $.post(blogBuildProPlugins.ajaxurl, {
                action: 'blog_build_dismiss_update_notice',
                nonce: blogBuildProPlugins.nonce
            });
        },

        bulkInstallRequired: function(e) {
            e.preventDefault();
            
            var $button = $(this);
            var originalText = $button.text();
            
            // Disable button and show loading
            $button.addClass('loading').prop('disabled', true);
            
            // Add progress indicator
            var $progress = $('<div class="bulk-install-progress active"><div class="progress-bar"><div class="progress-fill"></div></div><div class="progress-text">Preparing to install required plugins...</div></div>');
            $button.after($progress);
            
            // Animate progress bar from 0% to 30% while waiting for response
            setTimeout(function() {
                $progress.find('.progress-fill').css('width', '30%');
                $progress.find('.progress-text').text('Installing required plugins...');
            }, 200);
            
            // Simulate additional progress steps
            setTimeout(function() {
                if ($progress.find('.progress-fill').css('width') === '30%') {
                    $progress.find('.progress-fill').css('width', '60%');
                    $progress.find('.progress-text').text('Activating plugins...');
                }
            }, 2000);
            
            setTimeout(function() {
                if ($progress.find('.progress-fill').css('width') === '60%') {
                    $progress.find('.progress-fill').css('width', '80%');
                    $progress.find('.progress-text').text('Finalizing installation...');
                }
            }, 4000);
            
            $.ajax({
                url: blogBuildProPlugins.ajaxurl,
                type: 'POST',
                data: {
                    action: 'blog_build_install_required_plugins',
                    nonce: blogBuildProPlugins.nonce
                },
                success: function(response) {
                    $button.removeClass('loading').prop('disabled', false);
                    
                    if (response.success) {
                        // Animate progress to 100%
                        $progress.find('.progress-fill').css('width', '100%');
                        $progress.find('.progress-text').text('All required plugins installed and activated!');
                        
                        // Show success message
                        var $notice = $('<div class="notice notice-success is-dismissible"><p>' + response.data.message + '</p></div>');
                        $('.blog-build-plugins h1').after($notice);
                        
                        // Hide progress after 2 seconds
                        setTimeout(function() {
                            $progress.fadeOut(300, function() {
                                $(this).remove();
                            });
                        }, 2000);
                        
                        // Hide the install button and warning notice
                        $button.closest('.notice').fadeOut(300);
                        
                        // Refresh the page after 3 seconds to update plugin status
                        setTimeout(function() {
                            location.reload();
                        }, 3000);
                        
                    } else {
                        // Show error message
                        var $notice = $('<div class="notice notice-error is-dismissible"><p>' + response.data.message + '</p></div>');
                        $('.blog-build-plugins h1').after($notice);
                        
                        $progress.remove();
                    }
                },
                error: function() {
                    $button.removeClass('loading').prop('disabled', false);
                    
                    // Show error message
                    var $notice = $('<div class="notice notice-error is-dismissible"><p>An error occurred while installing plugins. Please try again.</p></div>');
                    $('.blog-build-plugins h1').after($notice);
                    
                    $progress.remove();
                }
            });
        },

        bulkInstallRecommended: function(e) {
            e.preventDefault();
            
            var $button = $(this);
            var originalText = $button.text();
            
            // Disable button and show loading
            $button.addClass('loading').prop('disabled', true);
            
            // Add progress indicator
            var $progress = $('<div class="bulk-install-progress active"><div class="progress-bar"><div class="progress-fill"></div></div><div class="progress-text">Preparing to install recommended plugins...</div></div>');
            $button.after($progress);
            
            // Animate progress bar from 0% to 30% while waiting for response
            setTimeout(function() {
                $progress.find('.progress-fill').css('width', '30%');
                $progress.find('.progress-text').text('Installing recommended plugins...');
            }, 200);
            
            // Simulate additional progress steps
            setTimeout(function() {
                if ($progress.find('.progress-fill').css('width') === '30%') {
                    $progress.find('.progress-fill').css('width', '60%');
                    $progress.find('.progress-text').text('Activating plugins...');
                }
            }, 2000);
            
            setTimeout(function() {
                if ($progress.find('.progress-fill').css('width') === '60%') {
                    $progress.find('.progress-fill').css('width', '80%');
                    $progress.find('.progress-text').text('Finalizing installation...');
                }
            }, 4000);
            
            $.ajax({
                url: blogBuildProPlugins.ajaxurl,
                type: 'POST',
                data: {
                    action: 'blog_build_install_recommended_plugins',
                    nonce: blogBuildProPlugins.nonce
                },
                success: function(response) {
                    $button.removeClass('loading').prop('disabled', false);
                    
                    if (response.success) {
                        // Animate progress to 100%
                        $progress.find('.progress-fill').css('width', '100%');
                        $progress.find('.progress-text').text('All recommended plugins installed and activated!');
                        
                        // Show success message
                        var $notice = $('<div class="notice notice-success is-dismissible"><p>' + response.data.message + '</p></div>');
                        $('h1').first().after($notice);
                        
                        // Hide progress after 2 seconds
                        setTimeout(function() {
                            $progress.fadeOut(300, function() {
                                $(this).remove();
                            });
                        }, 2000);
                        
                        // Hide the recommended notice immediately
                        $button.closest('.notice').fadeOut(300, function() {
                            $(this).remove();
                        });
                        
                        // Update the plugin status on the plugins page if we're there
                        if (window.location.href.indexOf('blog-build-plugins') !== -1) {
                            // Refresh the page after 3 seconds to update plugin status
                            setTimeout(function() {
                                location.reload();
                            }, 3000);
                        }
                        
                    } else {
                        // Show error message
                        var $notice = $('<div class="notice notice-error is-dismissible"><p>' + response.data.message + '</p></div>');
                        $('h1').first().after($notice);
                        
                        $progress.remove();
                    }
                },
                error: function() {
                    $button.removeClass('loading').prop('disabled', false);
                    
                    // Show error message
                    var $notice = $('<div class="notice notice-error is-dismissible"><p>An error occurred while installing plugins. Please try again.</p></div>');
                    $('h1').first().after($notice);
                    
                    $progress.remove();
                }
            });
        },

        updateAllPlugins: function(e) {
            e.preventDefault();
            
            var $button = $(this);
            var originalText = $button.text();
            
            // Disable button and show loading
            $button.addClass('loading').prop('disabled', true).text(blogBuildProPlugins.strings.updating);
            
            // Show progress bar
            PluginRecommendations.showBulkProgress($button, 'Updating plugins...');
            
            // Get all plugins that need updates
            var $updateButtons = $('.update-plugin');
            var total = $updateButtons.length;
            var completed = 0;
            
            if (total === 0) {
                PluginRecommendations.showMessage($button, 'No plugins need updates', 'info');
                $button.removeClass('loading').prop('disabled', false).text(originalText);
                return;
            }
            
            // Update each plugin
            $updateButtons.each(function() {
                var $updateBtn = $(this);
                var slug = $updateBtn.data('slug');
                var file = $updateBtn.data('file');
                var isLocal = $updateBtn.data('is-local');
                
                $.ajax({
                    url: blogBuildProPlugins.ajaxurl,
                    type: 'POST',
                    data: {
                        action: 'blog_build_update_plugin',
                        slug: slug,
                        file: file,
                        is_local: isLocal,
                        nonce: blogBuildProPlugins.nonce
                    },
                    success: function(response) {
                        completed++;
                        
                        if (response.success) {
                            PluginRecommendations.updatePluginStatus(slug, 'active');
                        }
                        
                        // Update progress
                        var progress = Math.round((completed / total) * 100);
                        PluginRecommendations.updateBulkProgress(progress);
                        
                        // Check if all updates are complete
                        if (completed === total) {
                            setTimeout(function() {
                                PluginRecommendations.hideBulkProgress();
                                PluginRecommendations.showMessage($button, 'All plugins updated successfully!', 'success');
                                $button.removeClass('loading').prop('disabled', false).text(originalText);
                                
                                // Hide update notices
                                $('.blog-build-pro-update-notice').fadeOut(300, function() {
                                    $(this).remove();
                                });
                                
                                // Refresh page to update plugin status
                                setTimeout(function() {
                                    window.location.reload();
                                }, 1500);
                            }, 500);
                        }
                    },
                    error: function() {
                        completed++;
                        
                        // Update progress
                        var progress = Math.round((completed / total) * 100);
                        PluginRecommendations.updateBulkProgress(progress);
                        
                        // Check if all updates are complete
                        if (completed === total) {
                            setTimeout(function() {
                                PluginRecommendations.hideBulkProgress();
                                PluginRecommendations.showMessage($button, 'Some plugins failed to update', 'error');
                                $button.removeClass('loading').prop('disabled', false).text(originalText);
                            }, 500);
                        }
                    }
                });
            });
        },

        checkRecommendedPluginsStatus: function() {
            // Check via AJAX if all recommended plugins are active
            $.ajax({
                url: blogBuildProPlugins.ajaxurl,
                type: 'POST',
                data: {
                    action: 'blog_build_check_recommended_plugins_status',
                    nonce: blogBuildProPlugins.nonce
                },
                success: function(response) {
                    if (response.success && response.data.all_active) {
                        // Hide recommended notice if all plugins are active
                        $('.blog-build-pro-plugin-notice').fadeOut(300, function() {
                            $(this).remove();
                        });
                    }
                },
                error: function() {
                    // Fallback: check individual plugin cards if available
                    var allActive = true;
                    $('.plugin-card[data-featured="1"]').each(function() {
                        if ($(this).attr('data-status') !== 'active') {
                            allActive = false;
                            return false; // break
                        }
                    });
                    
                    if (allActive) {
                        $('.blog-build-pro-plugin-notice').fadeOut(300, function() {
                            $(this).remove();
                        });
                    }
                }
            });
        }
    };

    // Expose to global scope for debugging
    window.PluginRecommendations = PluginRecommendations;

})(jQuery);
