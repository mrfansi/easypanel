<?php

declare(strict_types=1);

namespace Mrfansi\Easypanel\Services;

class BrandingService extends AbstractService
{
    /**
     * Get error page branding settings.
     */
    public function getErrorPageSettings(): array
    {
        return $this->makeRequest('branding.getErrorPageSettings');
    }

    /**
     * Get basic branding settings.
     */
    public function getBasicSettings(): array
    {
        return $this->makeRequest('branding.getBasicSettings');
    }

    /**
     * Get logo branding settings.
     */
    public function getLogoSettings(): array
    {
        return $this->makeRequest('branding.getLogoSettings');
    }

    /**
     * Get custom code branding settings.
     */
    public function getCustomCodeSettings(): array
    {
        return $this->makeRequest('branding.getCustomCodeSettings');
    }

    /**
     * Get links branding settings.
     */
    public function getLinksSettings(): array
    {
        return $this->makeRequest('branding.getLinksSettings');
    }

    /**
     * Get other links branding settings.
     */
    public function getOtherLinksSettings(): array
    {
        return $this->makeRequest('branding.getOtherLinksSettings');
    }

    /**
     * Get public interface settings.
     */
    public function getInterfaceSettingsPublic(): array
    {
        return $this->makeRequest('branding.getInterfaceSettingsPublic');
    }

    /**
     * Set error page branding settings.
     *
     * @param  bool  $hideLogo  Whether to hide the logo on error pages
     * @param  bool  $hideLinks  Whether to hide links on error pages
     * @param  string|null  $customCss  Custom CSS for error pages
     */
    public function setErrorPageSettings(bool $hideLogo, bool $hideLinks, ?string $customCss = null): array
    {
        $data = [
            'hideLogo' => $hideLogo,
            'hideLinks' => $hideLinks,
        ];

        if ($customCss !== null) {
            $data['customCss'] = $customCss;
        }

        return $this->makePostRequest('branding.setErrorPageSettings', $data);
    }

    /**
     * Set basic branding settings.
     *
     * @param  bool  $hideIp  Whether to hide IP address
     * @param  bool  $hideNotes  Whether to hide notes
     * @param  string  $serverName  The server name
     * @param  string  $serverColor  The server color
     */
    public function setBasicSettings(bool $hideIp, bool $hideNotes, string $serverName, string $serverColor): array
    {
        return $this->makePostRequest('branding.setBasicSettings', [
            'hideIp' => $hideIp,
            'hideNotes' => $hideNotes,
            'serverName' => $serverName,
            'serverColor' => $serverColor,
        ]);
    }

    /**
     * Set logo branding settings.
     *
     * @param  string|null  $lightLogoMark  Light theme logo mark
     * @param  string|null  $darkLogoMark  Dark theme logo mark
     * @param  string|null  $lightLogo  Light theme logo
     * @param  string|null  $darkLogo  Dark theme logo
     */
    public function setLogoSettings(?string $lightLogoMark = null, ?string $darkLogoMark = null, ?string $lightLogo = null, ?string $darkLogo = null): array
    {
        $data = [];

        if ($lightLogoMark !== null) {
            $data['lightLogoMark'] = $lightLogoMark;
        }
        if ($darkLogoMark !== null) {
            $data['darkLogoMark'] = $darkLogoMark;
        }
        if ($lightLogo !== null) {
            $data['lightLogo'] = $lightLogo;
        }
        if ($darkLogo !== null) {
            $data['darkLogo'] = $darkLogo;
        }

        return $this->makePostRequest('branding.setLogoSettings', $data);
    }

    /**
     * Set custom code branding settings.
     *
     * @param  string|null  $customCode  Custom code to inject
     */
    public function setCustomCodeSettings(?string $customCode = null): array
    {
        $data = [];

        if ($customCode !== null) {
            $data['customCode'] = $customCode;
        }

        return $this->makePostRequest('branding.setCustomCodeSettings', $data);
    }

    /**
     * Set links branding settings.
     *
     * @param  bool  $hideDocumentationLink  Whether to hide documentation link
     * @param  bool  $hideDiscordLink  Whether to hide Discord link
     * @param  bool  $hideFeedbackLink  Whether to hide feedback link
     * @param  bool  $hideChangelogLink  Whether to hide changelog link
     * @param  bool  $hideOtherLinks  Whether to hide other links
     */
    public function setLinksSettings(bool $hideDocumentationLink, bool $hideDiscordLink, bool $hideFeedbackLink, bool $hideChangelogLink, bool $hideOtherLinks): array
    {
        return $this->makePostRequest('branding.setLinksSettings', [
            'hideDocumentationLink' => $hideDocumentationLink,
            'hideDiscordLink' => $hideDiscordLink,
            'hideFeedbackLink' => $hideFeedbackLink,
            'hideChangelogLink' => $hideChangelogLink,
            'hideOtherLinks' => $hideOtherLinks,
        ]);
    }
}
