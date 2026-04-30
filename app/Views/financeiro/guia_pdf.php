<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Guia de Pagamento - RUPE</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Georgia', serif;
            background: #e8ecf0;
            color: #1a1a2e;
        }

        /* ── Barra de acção (não imprime) ── */
        .action-bar {
            background: #1e1b4b;
            padding: .85rem 1.5rem;
            display: flex;
            justify-content: center;
            gap: .75rem;
            position: sticky;
            top: 0;
            z-index: 10;
        }
        .btn-action {
            padding: .55rem 1.4rem;
            border: none;
            border-radius: 8px;
            font-size: .9rem;
            font-weight: 700;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: .4rem;
            text-decoration: none;
            transition: opacity .2s, transform .15s;
        }
        .btn-action:hover { opacity: .88; transform: translateY(-1px); }
        .btn-primary-act { background: #6366f1; color: #fff; }
        .btn-secondary-act { background: #64748b; color: #fff; }

        /* ── Folha ── */
        .guia-container {
            max-width: 780px;
            margin: 2rem auto 3rem;
            background: #fff;
            border: 1px solid #c7d2fe;
            border-top: 5px solid #4f46e5;
            border-radius: 4px;
            box-shadow: 0 8px 32px rgba(79,70,229,.12);
            overflow: hidden;
        }

        /* ── Cabeçalho ── */
        .doc-header {
            background: linear-gradient(135deg, #1e1b4b 0%, #312e81 60%, #4338ca 100%);
            color: #fff;
            padding: 1.75rem 2rem 1.5rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: .75rem;
            text-align: center;
        }
        .doc-header .insignia {
            width: 90px;
            height: auto;
            filter: drop-shadow(0 3px 8px rgba(0,0,0,.5));
        }
        .doc-header .header-text { text-align: center; }
        .doc-header .header-text h2 {
            font-size: 1.3rem;
            font-weight: 700;
            letter-spacing: .08em;
            text-transform: uppercase;
            margin-bottom: .2rem;
        }
        .doc-header .header-text h3 {
            font-size: .95rem;
            font-weight: 600;
            letter-spacing: .05em;
            color: #c7d2fe;
            margin-bottom: .15rem;
        }
        .doc-header .header-text p {
            font-size: .8rem;
            color: #a5b4fc;
            letter-spacing: .04em;
            text-transform: uppercase;
        }

        /* ── Corpo ── */
        .doc-body { padding: 1.75rem 2rem; }

        /* ── Tabela de info ── */
        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 1.5rem;
            font-size: .9rem;
        }
        .info-table td {
            padding: .85rem 1rem;
            border: 1px solid #e0e7ff;
            vertical-align: top;
            width: 50%;
        }
        .info-table td .label {
            font-size: .72rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .07em;
            color: #6366f1;
            margin-bottom: .3rem;
            display: block;
        }
        .info-table td .value {
            font-size: .95rem;
            font-weight: 600;
            color: #1e1b4b;
        }
        .info-table td .value.valor-destaque {
            font-size: 1.2rem;
            color: #059669;
        }

        /* ── Caixa RUPE ── */
        .rupe-box {
            background: linear-gradient(135deg, #f0f4ff 0%, #faf5ff 100%);
            border: 2px dashed #6366f1;
            border-radius: 10px;
            text-align: center;
            padding: 1.75rem 1.5rem;
            margin: 1.25rem 0;
        }
        .rupe-box .rupe-label {
            font-size: .78rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .08em;
            color: #4f46e5;
            margin-bottom: .75rem;
        }
        .rupe-numero {
            font-family: 'Courier New', monospace;
            font-size: 2rem;
            font-weight: 700;
            color: #1e1b4b;
            letter-spacing: .12em;
            display: block;
            margin-bottom: .75rem;
            background: #fff;
            border: 1px solid #c7d2fe;
            border-radius: 8px;
            padding: .5rem 1rem;
            display: inline-block;
        }
        .rupe-sem {
            font-size: 1.1rem;
            color: #b45309;
            font-weight: 600;
        }
        .rupe-box .rupe-instrucao {
            font-size: .83rem;
            color: #6b7280;
            margin-top: .5rem;
        }

        /* ── Notas ── */
        .notas-section {
            font-size: .83rem;
            color: #4b5563;
            line-height: 1.7;
            margin-top: 1.25rem;
        }
        .notas-section strong {
            color: #1e1b4b;
            font-size: .85rem;
        }
        .notas-section ul {
            padding-left: 1.2rem;
            margin-top: .4rem;
        }

        /* ── Rodapé ── */
        .doc-footer {
            border-top: 1px solid #e0e7ff;
            padding: .9rem 2rem;
            background: #f8faff;
            font-size: .75rem;
            color: #9ca3af;
            text-align: center;
        }

        /* ── Print ── */
        @media print {
            body { background: #fff; }
            .action-bar { display: none !important; }
            .guia-container {
                border: 1px solid #333;
                border-top: 3px solid #333;
                box-shadow: none;
                margin: 0;
                max-width: 100%;
            }
            .doc-header {
                background: #1e1b4b !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
            .rupe-box {
                border: 2px dashed #333;
                background: #f9f9f9 !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
        }
    </style>
</head>
<body>

    <!-- Barra de acção -->
    <div class="action-bar no-print">
        <button class="btn-action btn-primary-act" onclick="window.print()">
            🖨️ Imprimir Guia de Pagamento
        </button>
        <button class="btn-action btn-secondary-act" onclick="window.history.back()">
            ← Voltar
        </button>
    </div>

    <!-- Documento -->
    <div class="guia-container">

        <!-- Cabeçalho com insígnia -->
        <div class="doc-header">
            <img class="insignia"
                 src="https://th.bing.com/th/id/OIP.A3GkHH27rHG1iPY5OVpU8gAAAA?w=150&h=180&c=7&r=0&o=7&dpr=1.3&pid=1.7&rm=3"
                 alt="Insígnia da República de Angola"
                 onerror="this.style.display='none'">
            <div class="header-text">
                <h2>República de Angola</h2>
                <h3>Instituto Politécnico Industrial "17 de Dezembro"</h3>
                  <h3>SUBDIRECÇÃO PEDAGÓGICA"</h3>
                <p>Guia de Depósito / Pagamento (RUPE)</p>
            </div>
        </div>

        <!-- Corpo -->
        <div class="doc-body">

            <table class="info-table">
                <tr>
                    <td>
                        <span class="label">Nome do Aluno</span>
                        <span class="value"><?= mb_strtoupper(esc($aluno['nome'])) ?></span>
                    </td>
                    <td>
                        <span class="label">Data de Emissão</span>
                        <span class="value"><?= $data_emissao ?></span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <span class="label">Turma</span>
                        <span class="value"><?= esc($aluno['nome_turma']) ?> — <?= $aluno['classe'] ?>ª Classe</span>
                    </td>
                    <td>
                        <span class="label">Serviço</span>
                        <span class="value"><?= esc($servico) ?></span>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align:center; background:#f0fdf4; border-color:#a7f3d0;">
                        <span class="label" style="color:#059669">Valor a Pagar</span>
                        <span class="value valor-destaque"><?= esc($valor) ?></span>
                    </td>
                </tr>
            </table>

            <!-- Caixa RUPE -->
            <div class="rupe-box">
                <div class="rupe-label">🔑 Referência Única de Pagamento ao Estado (RUPE)</div>
                <?php if ($rupe && $rupe !== '---'): ?>
                    <span class="rupe-numero"><?= esc($rupe) ?></span>
                <?php else: ?>
                    <span class="rupe-sem">⚠ Referência RUPE não atribuída</span>
                <?php endif; ?>
                <p class="rupe-instrucao">Pague via Multicaixa, Internet Banking ou Agências Bancárias.</p>
            </div>

            <!-- Notas -->
            <div class="notas-section">
                <strong>Notas importantes:</strong>
                <ul>
                    <li>Esta guia é pessoal e intransferível.</li>
                    <li>O pagamento deve ser efetuado dentro do prazo de validade da referência.</li>
                    <li>A confirmação da matrícula será automática após a compensação do pagamento.</li>
                    <li>Guarde este documento como comprovativo até confirmação oficial.</li>
                </ul>
            </div>

        </div><!-- /doc-body -->

        <div class="doc-footer">
            Documento gerado eletronicamente em <?= date('d/m/Y H:i') ?> &mdash; Sistema de Gestão Escolar &mdash; República de Angola
        </div>

    </div><!-- /guia-container -->

</body>
</html>
